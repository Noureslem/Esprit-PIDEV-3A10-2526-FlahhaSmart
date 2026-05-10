<?php

declare(strict_types=1);

namespace App\Model;

final class IrrigationInput
{
    public function __construct(
        private readonly string $culture,
        private readonly float $surface,
        private readonly int $soilMoisture,
        private readonly \DateTimeImmutable $lastIrrigationDate,
        private readonly float $lastWaterAmount,
        private readonly string $location,
    ) {
    }

    public function getCulture(): string
    {
        return $this->culture;
    }

    public function getSurface(): float
    {
        return $this->surface;
    }

    public function getSoilMoisture(): int
    {
        return $this->soilMoisture;
    }

    public function getLastIrrigationDate(): \DateTimeImmutable
    {
        return $this->lastIrrigationDate;
    }

    public function getLastWaterAmount(): float
    {
        return $this->lastWaterAmount;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
}
