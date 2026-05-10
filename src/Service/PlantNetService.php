<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlantNetService
{
    private $httpClient;
    private $apiKey;
    private $project;

    public function __construct(HttpClientInterface $httpClient, string $plantnetApiKey, string $plantnetProject = 'all')
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $plantnetApiKey;
        $this->project = $plantnetProject;
    }

    /**
     * Identifie une plante à partir d'un fichier uploadé
     */
    public function identifyFromFile($imageFile): array
    {
        // Lire le contenu du fichier
        $imageContent = file_get_contents($imageFile->getPathname());
        
        // Créer la boundary pour multipart
        $boundary = '----------------------------' . uniqid();
        
        // Construire le corps de la requête manuellement
        $body = "--{$boundary}\r\n";
        $body .= "Content-Disposition: form-data; name=\"images\"; filename=\"{$imageFile->getClientOriginalName()}\"\r\n";
        $body .= "Content-Type: {$imageFile->getMimeType()}\r\n\r\n";
        $body .= $imageContent . "\r\n";
        $body .= "--{$boundary}--\r\n";
        
        // Construction de l'URL
        $url = sprintf(
            'https://my-api.plantnet.org/v2/identify/%s?api-key=%s&lang=fr&include-related-images=true',
            $this->project,
            $this->apiKey
        );
        
        // Envoi de la requête avec body
        $response = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
            ],
            'body' => $body,
        ]);

        return $response->toArray();
    }
}