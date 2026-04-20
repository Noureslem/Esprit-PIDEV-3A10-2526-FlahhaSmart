<?php

namespace App\Service\article;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImagePriceEstimatorService
{
    private $httpClient;
    private string $ollamaUrl;
    private string $model;

    public function __construct(HttpClientInterface $httpClient, string $ollamaUrl = 'http://localhost:11434/api/generate', string $model = 'qwen3-vl:4b')
    {
        $this->httpClient = $httpClient;
        $this->ollamaUrl = $ollamaUrl;
        $this->model = $model;
    }

    public function estimatePrice(UploadedFile $imageFile): ?string
    {
        try {
            // Read file and encode to base64
            $imageData = file_get_contents($imageFile->getPathname());
            $base64Image = base64_encode($imageData);

            $prompt = "based on this image can you guess the price of it just tell me the price dont explain or write anything tell me the price instantly give me the price of this product in tunisian dinars";

            $response = $this->httpClient->request('POST', $this->ollamaUrl, [
                'json' => [
                    'model' => $this->model,
                    'prompt' => $prompt,
                    'images' => [$base64Image],
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