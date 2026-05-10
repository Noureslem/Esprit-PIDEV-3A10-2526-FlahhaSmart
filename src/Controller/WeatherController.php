<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/api/weather', name: 'app_weather_current', methods: ['GET'])]
    public function current(Request $request, WeatherService $weatherService): JsonResponse
    {
        $city = (string) $request->query->get('city', 'Tunis');

        try {
            $data = $weatherService->getCurrentWeather($city);

            return $this->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\InvalidArgumentException $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_OK);
        } catch (\RuntimeException $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'error' => 'Erreur interne du service meteo.',
            ], Response::HTTP_OK);
        }
    }
}
