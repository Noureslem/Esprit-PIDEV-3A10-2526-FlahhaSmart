<?php

declare(strict_types=1);

namespace App\Model;

final class IrrigationPlan
{
    /**
     * @param array<string, scalar> $weather
     * @param array<int, string> $recommendations
     */
    public function __construct(
        private readonly float $waterAmount,
        private readonly int $duration,
        private readonly string $irrigationTime,
        private readonly string $irrigationDate,
        private readonly string $urgencyLevel,
        private readonly int $urgencyScore,
        private readonly string $urgencyCategory,
        private readonly string $justification,
        private readonly array $weather,
        private readonly array $recommendations,
    ) {
    }

    public function getWaterAmount(): float
    {
        return $this->waterAmount;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getIrrigationTime(): string
    {
        return $this->irrigationTime;
    }

    public function getIrrigationDate(): string
    {
        return $this->irrigationDate;
    }

    public function getUrgencyLevel(): string
    {
        return $this->urgencyLevel;
    }

    public function getUrgencyScore(): int
    {
        return $this->urgencyScore;
    }

    public function getUrgencyCategory(): string
    {
        return $this->urgencyCategory;
    }

    public function getJustification(): string
    {
        return $this->justification;
    }

    /**
     * @return array<string, scalar>
     */
    public function getWeather(): array
    {
        return $this->weather;
    }

    /**
     * @return array<int, string>
     */
    public function getRecommendations(): array
    {
        return $this->recommendations;
    }

    /**
     * @return array<string, int|float|string|array<int, string>|array<string, scalar>>
     */
    public function toArray(): array
    {
        return [
            'waterAmount' => $this->waterAmount,
            'duration' => $this->duration,
            'irrigationTime' => $this->irrigationTime,
            'irrigationDate' => $this->irrigationDate,
            'urgencyLevel' => $this->urgencyLevel,
            'urgencyScore' => $this->urgencyScore,
            'urgencyCategory' => $this->urgencyCategory,
            'justification' => $this->justification,
            'weather' => $this->weather,
            'recommendations' => $this->recommendations,
        ];
    }
}
