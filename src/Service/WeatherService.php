<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class WeatherService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $weatherstackApiKey,
        private readonly string $weatherstackEndpoint,
        private readonly int $weatherstackTimeout,
    ) {
    }

    /**
     * @return array{
     *   temperature:int,
    *   feelslike:int,
     *   weather_descriptions:string,
     *   humidity:int,
     *   wind_speed:int,
     *   icon:string,
     *   location:string
     * }
     */
    public function getCurrentWeather(string $location): array
    {
        $query = trim($location);
        if ($query == '') {
            throw new \InvalidArgumentException('La ville est obligatoire.');
        }

        if ($this->weatherstackApiKey == '') {
            throw new \RuntimeException('WEATHERSTACK_API_KEY manquante.');
        }

        try {
            $response = $this->httpClient->request('GET', $this->weatherstackEndpoint, [
                'query' => [
                    'access_key' => $this->weatherstackApiKey,
                    'query' => $query,
                ],
                'timeout' => $this->weatherstackTimeout / 1000,
            ]);

            $data = $response->toArray(false);
        } catch (ExceptionInterface $e) {
            throw new \RuntimeException('Service météo indisponible.', 0, $e);
        }

        if (isset($data['success']) && $data['success'] === false) {
            $message = (string) ($data['error']['info'] ?? 'Erreur Weatherstack.');
            $code = (int) ($data['error']['code'] ?? 0);

            // Request/input-related API errors should be returned as 4xx to the UI.
            if (in_array($code, [601, 602, 603, 604, 605, 606, 607, 611, 615], true)) {
                throw new \InvalidArgumentException($message);
            }

            throw new \RuntimeException($message);
        }

        if (!isset($data['current'], $data['location'])) {
            throw new \InvalidArgumentException('Ville introuvable ou réponse météo invalide.');
        }

        return [
            'temperature' => (int) ($data['current']['temperature'] ?? 0),
            'feelslike' => (int) ($data['current']['feelslike'] ?? ($data['current']['temperature'] ?? 0)),
            'weather_descriptions' => (string) (($data['current']['weather_descriptions'][0] ?? 'N/A')),
            'humidity' => (int) ($data['current']['humidity'] ?? 0),
            'wind_speed' => (int) ($data['current']['wind_speed'] ?? 0),
            'icon' => (string) (($data['current']['weather_icons'][0] ?? '')),
            'location' => (string) (($data['location']['name'] ?? $query) . ', ' . ($data['location']['country'] ?? '')),
        ];
    }
}
