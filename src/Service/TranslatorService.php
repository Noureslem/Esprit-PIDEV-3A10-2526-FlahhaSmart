<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class TranslatorService
{
    /** @var list<string> */
    private const SUPPORTED_LANGUAGES = ['fr', 'en', 'ar'];

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly LoggerInterface $logger,
        private readonly CacheInterface $cache,
        private readonly string $azureTranslatorEndpoint,
        private readonly string $azureTranslatorRegion,
        private readonly string $azureTranslatorKeyPrimary,
        private readonly string $azureTranslatorKeySecondary,
        private readonly int $azureTranslatorCacheTtlSeconds,
    ) {
    }

    public function translate(string $text, string $to, ?string $from = null): string
    {
        $text = trim($text);
        if ($text == '') {
            return '';
        }

        $to = strtolower(trim($to));
        $from = $from !== null ? strtolower(trim($from)) : null;

        if (!in_array($to, self::SUPPORTED_LANGUAGES, true)) {
            throw new \InvalidArgumentException(sprintf('Unsupported target language "%s".', $to));
        }

        if ($from !== null && !in_array($from, self::SUPPORTED_LANGUAGES, true)) {
            throw new \InvalidArgumentException(sprintf('Unsupported source language "%s".', $from));
        }

        if ($this->azureTranslatorKeyPrimary === '') {
            throw new \RuntimeException('Azure Translator is not configured (missing key). Put keys in .env.local.');
        }

        $cacheKey = $this->cacheKey($text, $to, $from);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($text, $to, $from): string {
            $item->expiresAfter(max(60, $this->azureTranslatorCacheTtlSeconds));

            return $this->translateViaAzure($text, $to, $from);
        });
    }

    private function translateViaAzure(string $text, string $to, ?string $from): string
    {
        $url = rtrim($this->azureTranslatorEndpoint, '/') . '/translate?api-version=3.0&to=' . rawurlencode($to);
        if ($from !== null && $from !== '') {
            $url .= '&from=' . rawurlencode($from);
        }

        $payload = [
            ['Text' => $text],
        ];

        try {
            return $this->requestAndExtractTranslation($url, $payload, $this->azureTranslatorKeyPrimary);
        } catch (ClientExceptionInterface $e) {
            // If the key is invalid/expired, try the secondary key as fallback.
            $status = $e->getResponse()->getStatusCode();
            if (($status === 401 || $status === 403) && $this->azureTranslatorKeySecondary !== '') {
                try {
                    return $this->requestAndExtractTranslation($url, $payload, $this->azureTranslatorKeySecondary);
                } catch (\Throwable $e2) {
                    $this->logger->warning('Azure Translator fallback key failed.', ['exception' => $e2]);
                }
            }

            $this->logger->warning('Azure Translator client error.', ['status' => $status, 'exception' => $e]);
        } catch (TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|DecodingExceptionInterface $e) {
            $this->logger->error('Azure Translator request failed.', ['exception' => $e]);
        } catch (\Throwable $e) {
            $this->logger->error('Azure Translator unexpected error.', ['exception' => $e]);
        }

        // Fallback: keep original text if Azure is down.
        return $text;
    }

    /**
     * @param array<int, array{Text: string}> $payload
     */
    private function requestAndExtractTranslation(string $url, array $payload, string $key): string
    {
        $response = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $key,
                'Ocp-Apim-Subscription-Region' => $this->azureTranslatorRegion,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload,
            'timeout' => 8,
        ]);

        // getContent() throws on 4xx/5xx; we want the proper exception types.
        $data = $response->toArray();

        // Expected structure: [ { translations: [ { text: "..." } ] } ]
        $translated = $data[0]['translations'][0]['text'] ?? null;
        if (!is_string($translated) || $translated === '') {
            throw new \RuntimeException('Azure Translator returned an unexpected response.');
        }

        return $translated;
    }

    private function cacheKey(string $text, string $to, ?string $from): string
    {
        $fromPart = $from ?? '';

        return 'azure_translator.' . hash('sha256', $fromPart . '|' . $to . '|' . $text);
    }
}
