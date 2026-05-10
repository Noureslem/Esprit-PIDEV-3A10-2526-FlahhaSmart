<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class DiseaseAiClient
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $diseaseAiBaseUrl,
        private readonly int $diseaseAiTimeout,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function predictDisease(UploadedFile $image, ?string $requestId = null): array
    {
        if (!$image->isValid()) {
            throw new \InvalidArgumentException('Le fichier image est invalide.');
        }

        $endpoint = rtrim($this->diseaseAiBaseUrl, '/') . '/predict-disease';

        $form = new FormDataPart([
            'image' => DataPart::fromPath(
                $image->getPathname(),
                $image->getClientOriginalName() ?: 'image',
                $image->getMimeType() ?: 'application/octet-stream',
            ),
        ]);

        $headers = $form->getPreparedHeaders()->toArray();
        $headers['Accept'] = 'application/json';
        if (is_string($requestId) && trim($requestId) !== '') {
            $headers['X-Request-Id'] = $requestId;
        }

        try {
            $response = $this->httpClient->request('POST', $endpoint, [
                'headers' => $headers,
                'body' => $form->bodyToIterable(),
                'timeout' => $this->diseaseAiTimeout / 1000,
            ]);

            $status = $response->getStatusCode();
            $payload = $response->toArray(false);

            if ($status >= 400) {
                $message = (string) ($payload['error']['message'] ?? $payload['message'] ?? 'Erreur microservice maladie.');
                throw new \RuntimeException($message);
            }

            return $payload;
        } catch (ExceptionInterface $e) {
            throw new \RuntimeException('Microservice maladie indisponible.', 0, $e);
        }
    }
}
