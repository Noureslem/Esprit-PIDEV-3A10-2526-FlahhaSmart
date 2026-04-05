<?php

namespace App\Service\article;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ConsultantBotService
{
    private $httpClient;
    private $ollamaUrl;
    private $model;

    public function __construct(HttpClientInterface $httpClient, string $ollamaUrl = 'http://localhost:11434/api/generate', string $model = 'deepseek-r1:1.5b')
    {
        $this->httpClient = $httpClient;
        $this->ollamaUrl = $ollamaUrl;
        $this->model = $model;
    }

    public function ask(string $prompt): ?string
    {
        try {
            $response = $this->httpClient->request('POST', $this->ollamaUrl, [
                'json' => [
                    'model' => $this->model,
                    'prompt' => $prompt . ' (Réponds en français)',
                    'stream' => false,
                ],
                'timeout' => 60,
            ]);

            $data = $response->toArray();
            return $data['response'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}