<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class WeatherService
{
    private const OPEN_METEO_GEOCODING_ENDPOINT = 'https://geocoding-api.open-meteo.com/v1/search';
    private const OPEN_METEO_FORECAST_ENDPOINT = 'https://api.open-meteo.com/v1/forecast';

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

        // Weatherstack peut renvoyer des erreurs génériques (ex: code 615) selon le plan/état du service.
        // Pour garantir une météo fonctionnelle, on bascule sur Open-Meteo si la configuration Weatherstack
        // est absente ou si l'API échoue côté serveur.
        if ($this->weatherstackApiKey == '' || $this->weatherstackEndpoint == '') {
            return $this->getCurrentWeatherFromOpenMeteo($query);
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
            return $this->getCurrentWeatherFromOpenMeteo($query);
        }

        if (isset($data['success']) && $data['success'] === false) {
            $message = (string) ($data['error']['info'] ?? 'Erreur Weatherstack.');
            $code = (int) ($data['error']['code'] ?? 0);

            // Request/input-related API errors should be returned as 4xx to the UI.
            if (in_array($code, [601, 602, 603, 604, 605, 606, 607, 611], true)) {
                throw new \InvalidArgumentException($message);
            }

            // Weatherstack server-side / plan / quota issues: fallback provider.
            if (in_array($code, [101, 105, 106, 615], true)) {
                return $this->getCurrentWeatherFromOpenMeteo($query);
            }

            return $this->getCurrentWeatherFromOpenMeteo($query);
        }

        if (!isset($data['current'], $data['location'])) {
            return $this->getCurrentWeatherFromOpenMeteo($query);
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
    private function getCurrentWeatherFromOpenMeteo(string $query): array
    {
        try {
            $geoResponse = $this->httpClient->request('GET', self::OPEN_METEO_GEOCODING_ENDPOINT, [
                'query' => [
                    'name' => $query,
                    'count' => 1,
                    'language' => 'fr',
                    'format' => 'json',
                ],
                'timeout' => $this->weatherstackTimeout / 1000,
            ]);

            $geoData = $geoResponse->toArray(false);
        } catch (ExceptionInterface $e) {
            throw new \RuntimeException('Service météo indisponible.', 0, $e);
        }

        $result = $geoData['results'][0] ?? null;
        if (!is_array($result) || !isset($result['latitude'], $result['longitude'])) {
            throw new \InvalidArgumentException('Ville introuvable.');
        }

        $latitude = (float) $result['latitude'];
        $longitude = (float) $result['longitude'];

        try {
            $forecastResponse = $this->httpClient->request('GET', self::OPEN_METEO_FORECAST_ENDPOINT, [
                'query' => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'timezone' => 'auto',
                    'windspeed_unit' => 'kmh',
                    'current' => 'temperature_2m,apparent_temperature,relative_humidity_2m,wind_speed_10m,weather_code',
                ],
                'timeout' => $this->weatherstackTimeout / 1000,
            ]);

            $forecastData = $forecastResponse->toArray(false);
        } catch (ExceptionInterface $e) {
            throw new \RuntimeException('Service météo indisponible.', 0, $e);
        }

        $current = $forecastData['current'] ?? null;
        if (!is_array($current)) {
            throw new \RuntimeException('Réponse météo invalide.');
        }

        $temperature = (int) round((float) ($current['temperature_2m'] ?? 0));
        $feelsLike = (int) round((float) ($current['apparent_temperature'] ?? $temperature));
        $humidity = (int) round((float) ($current['relative_humidity_2m'] ?? 0));
        $windSpeed = (int) round((float) ($current['wind_speed_10m'] ?? 0));
        $weatherCode = (int) ($current['weather_code'] ?? 0);

        $locationName = (string) ($result['name'] ?? $query);
        $country = (string) ($result['country'] ?? '');
        $locationText = trim($locationName . ($country !== '' ? ', ' . $country : ''));

        return [
            'temperature' => $temperature,
            'feelslike' => $feelsLike,
            'weather_descriptions' => $this->describeOpenMeteoWeatherCode($weatherCode),
            'humidity' => $humidity,
            'wind_speed' => $windSpeed,
            'icon' => '',
            'location' => $locationText !== '' ? $locationText : $query,
        ];
    }

    private function describeOpenMeteoWeatherCode(int $code): string
    {
        return match (true) {
            $code === 0 => 'Ensoleillé',
            in_array($code, [1, 2, 3], true) => 'Nuageux',
            in_array($code, [45, 48], true) => 'Brouillard',
            in_array($code, [51, 53, 55, 56, 57], true) => 'Bruine',
            in_array($code, [61, 63, 65, 66, 67], true) => 'Pluie',
            in_array($code, [71, 73, 75, 77], true) => 'Neige',
            in_array($code, [80, 81, 82], true) => 'Averses',
            in_array($code, [95, 96, 99], true) => 'Orage',
            default => 'Conditions variables',
        };
    }
}
