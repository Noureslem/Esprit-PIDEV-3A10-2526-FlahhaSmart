<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class GeminiChatService
{
    /**
     * System prompt for agricultural expertise
     */
    private const SYSTEM_PROMPT = <<<'PROMPT'
You are an expert agricultural assistant helping farmers with crops, irrigation, soil, pests, equipment maintenance, and sustainable farming practices. 
You must respond ONLY to questions related to agriculture, agronomy, farming, and related topics.

If someone asks something unrelated to agriculture, politely decline and redirect them to agricultural topics.
Provide practical, actionable advice based on best practices in modern agriculture.

Your responses should be:
- Clear and concise
- Practical and actionable
- Based on sustainable practices
- Multilingual-aware (respond in the user's language)
PROMPT;

    private const FALLBACK_MESSAGE = 'I apologize, but I encountered a problem processing your request. Please try again later.';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly LoggerInterface $logger,
        private readonly string $geminiApiEndpoint,
        private readonly string $geminiModelName,
        private readonly string $geminiApiKey,
        private readonly int $geminiApiTimeout,
        private readonly bool $geminiChatbotEnabled,
    ) {
    }

    /**
     * Ask the chatbot a question
     *
     * @param string $message The user's message
     * @return string The chatbot's response
     * @throws \InvalidArgumentException If message is empty or too long
     */
    public function ask(string $message): string
    {
        if (!$this->geminiChatbotEnabled) {
            $this->logger->warning('Gemini chatbot is disabled');
            return 'The chatbot service is currently unavailable.';
        }

        $message = trim($message);

        if (empty($message)) {
            throw new \InvalidArgumentException('Message cannot be empty.');
        }

        if (strlen($message) > 2000) {
            throw new \InvalidArgumentException('Message is too long. Maximum 2000 characters allowed.');
        }

        if (empty($this->geminiApiKey)) {
            $this->logger->error('Gemini API key is not configured');
            return self::FALLBACK_MESSAGE;
        }

        try {
            return $this->callGeminiApi($message);
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface $e) {
            $this->logger->error('Gemini API request failed', [
                'exception' => $e::class,
                'message' => $e->getMessage(),
            ]);
            return self::FALLBACK_MESSAGE;
        } catch (\Throwable $e) {
            $this->logger->error('Unexpected error in Gemini chatbot', [
                'exception' => $e::class,
                'message' => $e->getMessage(),
            ]);
            return self::FALLBACK_MESSAGE;
        }
    }

    /**
     * Call the Gemini API
     *
     * @param string $message The user's message
     * @return string The API response
     * @throws \Exception If API call fails
     */
    private function callGeminiApi(string $message): string
    {
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $message,
                        ],
                    ],
                ],
            ],
            'systemInstruction' => [
                'parts' => [
                    [
                        'text' => self::SYSTEM_PROMPT,
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'topP' => 0.95,
                'topK' => 64,
                'maxOutputTokens' => 1024,
            ],
        ];

        $url = $this->geminiApiEndpoint . '?key=' . urlencode($this->geminiApiKey);

        $this->logger->debug('Calling Gemini API', [
            'url' => preg_replace('/key=.*/', 'key=***', $url),
            'message_length' => strlen($message),
        ]);

        $response = $this->httpClient->request(
            'POST',
            $url,
            [
                'json' => $payload,
                'timeout' => $this->geminiApiTimeout / 1000, // Convert ms to seconds
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        $statusCode = $response->getStatusCode();

        $this->logger->debug('Gemini API response', ['status' => $statusCode]);

        if ($statusCode !== 200) {
            $errorContent = $response->getContent(false);
            $this->logger->error('Gemini API error response', [
                'status' => $statusCode,
                'body' => $errorContent,
            ]);
            
            $errorData = json_decode($errorContent, true) ?? [];
            $errorMessage = $errorData['error']['message'] ?? 'Unknown error';
            throw new \RuntimeException("Gemini API returned status {$statusCode}: {$errorMessage}");
        }

        $data = json_decode($response->getContent(), true);

        if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            $this->logger->error('Unexpected Gemini API response format', ['data' => $data]);
            throw new \RuntimeException('Unexpected response format from Gemini API');
        }

        return $data['candidates'][0]['content']['parts'][0]['text'];
    }
}
