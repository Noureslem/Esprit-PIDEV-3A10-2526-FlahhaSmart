<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\IrrigationInput;
use App\Model\IrrigationPlan;

final class IrrigationService
{
    private const FLOW_RATE_L_PER_MIN = 10.0;
    private const NETWORK_EFFICIENCY = 0.88;
    private const MAX_WATER_PER_M2 = 12.0;

    /**
     * liters per m2
     */
    private const BASE_NEEDS = [
        'ble' => 5.0,
        'mais' => 7.0,
        'tomate' => 6.0,
        'riz' => 8.0,
        'lentille' => 4.0,
        'pois' => 4.5,
        'patate' => 5.5,
        'betterave' => 5.0,
        'oignon' => 4.8,
        'carotte' => 4.6,
    ];

    public function __construct(private readonly WeatherService $weatherService)
    {
    }

    /**
     * @return array<string, string>
     */
    public function getSupportedCultures(): array
    {
        return [
            'ble' => 'Ble',
            'mais' => 'Mais',
            'tomate' => 'Tomate',
            'riz' => 'Riz',
            'lentille' => 'Lentille',
            'pois' => 'Pois',
            'patate' => 'Patate',
            'betterave' => 'Betterave',
            'oignon' => 'Oignon',
            'carotte' => 'Carotte',
        ];
    }

    public function generateIrrigationPlan(IrrigationInput $input): IrrigationPlan
    {
        $weather = $this->resolveWeatherData($input->getLocation());
        $temperature = (float) ($weather['temperature'] ?? 0.0);
        $humidity = (int) ($weather['humidity'] ?? 0);
        $description = (string) ($weather['weather_descriptions'] ?? '');

        $surfaceM2 = max(0.1, $input->getSurface()) * 10000;
        $baseNeed = $this->resolveBaseNeed($input->getCulture());

        $temperatureFactor = $this->calculateTemperatureFactor($temperature);
        $humidityFactor = $this->calculateHumidityFactor($humidity);
        [$weatherFactor, $rainDelayDays, $weatherFlags] = $this->calculateWeatherFactor($description);
        $soilFactor = $this->calculateSoilFactor($input->getSoilMoisture());
        $historyFactor = $this->calculateHistoryFactor($input->getLastIrrigationDate(), $input->getLastWaterAmount());

        $rawWaterAmount = $surfaceM2 * $baseNeed * $temperatureFactor * $humidityFactor * $weatherFactor * $soilFactor * $historyFactor;
        $waterAmount = $this->normalizeWaterAmount($rawWaterAmount, $surfaceM2);

        $urgencyScore = $this->calculateUrgencyScore($input->getSoilMoisture(), $temperature, $humidity, $weatherFlags);
        $urgencyCategory = $this->resolveUrgencyCategory($urgencyScore);
        $urgencyLevel = $this->resolveUrgencyLevel($urgencyCategory);

        if ($input->getSoilMoisture() > 80 || $weatherFlags['rain']) {
            $waterAmount = 0.0;
        }

        $duration = $this->calculateDurationMinutes($waterAmount);
        $irrigationTime = $this->resolveOptimalTime($temperature, $urgencyCategory);
        $irrigationDate = $this->resolveIrrigationDate($urgencyCategory, $rainDelayDays, $input->getSoilMoisture());

        $justification = $this->buildJustification(
            temperature: $temperature,
            humidity: $humidity,
            soilMoisture: $input->getSoilMoisture(),
            description: $description,
            waterAmount: $waterAmount,
            usedWeatherFallback: (bool) ($weather['fallback'] ?? false),
        );

        return new IrrigationPlan(
            waterAmount: $waterAmount,
            duration: $duration,
            irrigationTime: $irrigationTime,
            irrigationDate: $irrigationDate,
            urgencyLevel: $urgencyLevel,
            urgencyScore: $urgencyScore,
            urgencyCategory: $urgencyCategory,
            justification: $justification,
            weather: [
                'location' => (string) ($weather['location'] ?? $input->getLocation()),
                'temperature' => $temperature,
                'humidity' => $humidity,
                'description' => $description,
                'source' => (string) ($weather['source'] ?? 'api'),
            ],
            recommendations: $this->buildRecommendations($urgencyCategory, $weatherFlags, $input->getSoilMoisture()),
        );
    }

    /**
     * @return array<string, int|float|string|bool>
     */
    private function resolveWeatherData(string $location): array
    {
        $city = trim($location);
        if ($city === '') {
            throw new \InvalidArgumentException('La ville est obligatoire pour recuperer la meteo.');
        }

        try {
            $data = $this->weatherService->getCurrentWeather($city);
            $data['source'] = 'api';
            $data['fallback'] = false;

            return $data;
        } catch (\Throwable) {
            return [
                'temperature' => 24,
                'weather_descriptions' => 'Clear',
                'humidity' => 55,
                'location' => $city,
                'source' => 'fallback',
                'fallback' => true,
            ];
        }
    }

    private function resolveBaseNeed(string $culture): float
    {
        $key = strtolower(trim($culture));

        if (!isset(self::BASE_NEEDS[$key])) {
            throw new \InvalidArgumentException('Culture non prise en charge.');
        }

        return self::BASE_NEEDS[$key];
    }

    private function calculateTemperatureFactor(float $temperature): float
    {
        if ($temperature > 35) {
            return 1.4;
        }

        if ($temperature >= 25 && $temperature <= 35) {
            return 1.2;
        }

        if ($temperature < 10) {
            return 0.7;
        }

        return 1.0;
    }

    private function calculateHumidityFactor(int $humidity): float
    {
        if ($humidity > 85) {
            return 0.5;
        }

        if ($humidity >= 60) {
            return 0.8;
        }

        if ($humidity < 40) {
            return 1.3;
        }

        return 1.0;
    }

    /**
     * @return array{0:float,1:int,2:array{rain:bool,cloudy:bool,sunny:bool}}
     */
    private function calculateWeatherFactor(string $description): array
    {
        $value = mb_strtolower($description);
        $isRain = str_contains($value, 'rain') || str_contains($value, 'pluie');
        $isCloudy = str_contains($value, 'cloud') || str_contains($value, 'nuage');
        $isSunny = str_contains($value, 'sun') || str_contains($value, 'clear') || str_contains($value, 'soleil');

        if ($isRain) {
            return [0.0, 1, ['rain' => true, 'cloudy' => $isCloudy, 'sunny' => $isSunny]];
        }

        if ($isCloudy) {
            return [0.9, 0, ['rain' => false, 'cloudy' => true, 'sunny' => false]];
        }

        if ($isSunny) {
            return [1.15, 0, ['rain' => false, 'cloudy' => false, 'sunny' => true]];
        }

        return [1.0, 0, ['rain' => false, 'cloudy' => false, 'sunny' => false]];
    }

    private function calculateSoilFactor(int $soilMoisture): float
    {
        if ($soilMoisture > 80) {
            return 0.0;
        }

        if ($soilMoisture >= 50) {
            return 0.65;
        }

        if ($soilMoisture >= 30) {
            return 1.0;
        }

        return 1.4;
    }

    private function calculateHistoryFactor(\DateTimeImmutable $lastIrrigationDate, float $lastWaterAmount): float
    {
        $hoursSinceIrrigation = (int) floor((time() - $lastIrrigationDate->getTimestamp()) / 3600);
        $hoursSinceIrrigation = max(0, $hoursSinceIrrigation);

        if ($hoursSinceIrrigation < 24) {
            return 0.6 * $this->calculateVolumeHistoryAdjustment($lastWaterAmount);
        }

        if ($hoursSinceIrrigation < 72) {
            return 0.8 * $this->calculateVolumeHistoryAdjustment($lastWaterAmount);
        }

        return 1.0 * $this->calculateVolumeHistoryAdjustment($lastWaterAmount);
    }

    private function calculateVolumeHistoryAdjustment(float $lastWaterAmount): float
    {
        if ($lastWaterAmount >= 2000) {
            return 0.85;
        }

        if ($lastWaterAmount >= 1000) {
            return 0.93;
        }

        return 1.0;
    }

    private function normalizeWaterAmount(float $waterAmount, float $surfaceM2): float
    {
        $max = $surfaceM2 * self::MAX_WATER_PER_M2;
        $normalized = min(max(0.0, $waterAmount), max(0.0, $max));

        return round($normalized, 1);
    }

    private function calculateDurationMinutes(float $waterAmount): int
    {
        if ($waterAmount <= 0) {
            return 0;
        }

        $effectiveFlow = max(1.0, self::FLOW_RATE_L_PER_MIN * self::NETWORK_EFFICIENCY);

        return (int) ceil($waterAmount / $effectiveFlow);
    }

    /**
     * @param array{rain:bool,cloudy:bool,sunny:bool} $weatherFlags
     */
    private function calculateUrgencyScore(int $soilMoisture, float $temperature, int $humidity, array $weatherFlags): int
    {
        $score = 0;

        if ($soilMoisture < 30) {
            $score += 60;
        } elseif ($soilMoisture < 50) {
            $score += 35;
        } elseif ($soilMoisture < 80) {
            $score += 10;
        }

        if ($temperature > 35) {
            $score += 25;
        } elseif ($temperature >= 25) {
            $score += 15;
        } elseif ($temperature < 10) {
            $score -= 10;
        }

        if ($humidity < 40) {
            $score += 15;
        } elseif ($humidity > 85) {
            $score -= 20;
        }

        if ($weatherFlags['rain']) {
            $score -= 35;
        } elseif ($weatherFlags['cloudy']) {
            $score -= 8;
        } elseif ($weatherFlags['sunny']) {
            $score += 8;
        }

        return max(0, min(100, $score));
    }

    private function resolveUrgencyCategory(int $score): string
    {
        if ($score >= 80) {
            return 'critique';
        }

        if ($score >= 50) {
            return 'eleve';
        }

        if ($score >= 20) {
            return 'moyen';
        }

        return 'faible';
    }

    private function resolveUrgencyLevel(string $category): string
    {
        return match ($category) {
            'critique' => 'high',
            'eleve' => 'medium',
            default => 'low',
        };
    }

    private function resolveOptimalTime(float $temperature, string $urgencyCategory): string
    {
        if ($temperature > 32) {
            return '19:00';
        }

        if ($urgencyCategory === 'critique') {
            return '05:30';
        }

        return '06:00';
    }

    private function resolveIrrigationDate(string $urgencyCategory, int $rainDelayDays, int $soilMoisture): string
    {
        $baseDays = match ($urgencyCategory) {
            'critique' => 0,
            'eleve' => 1,
            'moyen' => 2,
            default => 3,
        };

        if ($soilMoisture > 80) {
            $baseDays = max($baseDays, 3);
        }

        $date = (new \DateTimeImmutable('today'))->modify(sprintf('+%d days', $baseDays + $rainDelayDays));

        return $date->format('Y-m-d');
    }

    /**
     * @param array{rain:bool,cloudy:bool,sunny:bool} $weatherFlags
     * @return array<int, string>
     */
    private function buildRecommendations(string $urgencyCategory, array $weatherFlags, int $soilMoisture): array
    {
        $recommendations = [];

        if ($weatherFlags['rain']) {
            $recommendations[] = 'Pluie detectee: reporter le cycle et verifier le drainage.';
        }

        if ($soilMoisture < 30) {
            $recommendations[] = 'Sol tres sec: privilegier un cycle court immediate puis un controle apres 12h.';
        }

        if ($weatherFlags['sunny']) {
            $recommendations[] = 'Temps ensoleille: preferer une irrigation en fin de journee pour limiter l evaporation.';
        }

        if ($urgencyCategory === 'critique') {
            $recommendations[] = 'Niveau critique: surveiller la parcelle apres irrigation et ajuster le volume progressivement.';
        }

        if (empty($recommendations)) {
            $recommendations[] = 'Conditions relativement stables: maintenir un suivi quotidien de l humidite du sol.';
        }

        return $recommendations;
    }

    private function buildJustification(
        float $temperature,
        int $humidity,
        int $soilMoisture,
        string $description,
        float $waterAmount,
        bool $usedWeatherFallback,
    ): string {
        $parts = [];

        if ($temperature > 30) {
            $parts[] = sprintf('Temperature elevee (%.1f deg C)', $temperature);
        } elseif ($temperature < 10) {
            $parts[] = sprintf('Temperature basse (%.1f deg C)', $temperature);
        }

        if ($humidity < 40) {
            $parts[] = sprintf('humidite de l air faible (%d%%)', $humidity);
        } elseif ($humidity > 85) {
            $parts[] = sprintf('humidite de l air tres elevee (%d%%)', $humidity);
        }

        if ($soilMoisture < 30) {
            $parts[] = sprintf('sol tres sec (%d%%)', $soilMoisture);
        } elseif ($soilMoisture > 80) {
            $parts[] = sprintf('sol deja humide (%d%%)', $soilMoisture);
        } else {
            $parts[] = sprintf('humidite du sol intermediaire (%d%%)', $soilMoisture);
        }

        if ($description !== '') {
            $parts[] = sprintf('condition meteo: %s', $description);
        }

        if ($usedWeatherFallback) {
            $parts[] = 'meteo estimee via mode secours';
        }

        return sprintf('%s. Volume conseille: %.1f L.', ucfirst(implode(', ', $parts)), $waterAmount);
    }
}
