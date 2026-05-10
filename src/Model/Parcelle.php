<?php

namespace App\Model;

/**
 * Représente une parcelle avec ses caractéristiques
 * Classe métier simple (POPO)
 */
final class Parcelle
{
    public function __construct(
        private readonly float $surface,
        private readonly string $typeSol,
        private readonly ?string $derniereCulture = null,
        private readonly ?string $avantDerniereCulture = null,
        private readonly int $niveauAzote = 5,
        private readonly int $niveauPhosphore = 5,
        private readonly int $niveauPotassium = 5,
        private readonly float $ph = 6.5,
        private readonly int $anneesDepuisJachere = 0,
    ) {}

    public function getSurface(): float
    {
        return $this->surface;
    }

    public function getTypeSol(): string
    {
        return $this->typeSol;
    }

    public function getDerniereCulture(): ?string
    {
        return $this->derniereCulture;
    }

    public function getAvantDerniereCulture(): ?string
    {
        return $this->avantDerniereCulture;
    }

    public function getNiveauAzote(): int
    {
        return $this->niveauAzote;
    }

    public function getNiveauPhosphore(): int
    {
        return $this->niveauPhosphore;
    }

    public function getNiveauPotassium(): int
    {
        return $this->niveauPotassium;
    }

    public function getPH(): float
    {
        return $this->ph;
    }

    public function getAnneesDepuisJachere(): int
    {
        return $this->anneesDepuisJachere;
    }

    public function getNiveauNutrientsTotal(): int
    {
        return $this->niveauAzote + $this->niveauPhosphore + $this->niveauPotassium;
    }

    public function isSolEpuise(): bool
    {
        return $this->getNiveauNutrientsTotal() < 10;
    }

    public function isAzotePauvre(): bool
    {
        return $this->niveauAzote < 4;
    }
}
