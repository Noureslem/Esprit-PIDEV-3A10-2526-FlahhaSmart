<?php

namespace App\Model;

/**
 * Représente une recommandation de culture
 */
final class RecommandationCulture
{
    public function __construct(
        private readonly string $culture,
        private readonly string $famille,
        private readonly int $scoreCompatibilite,
        private readonly string $raisonRecommandation,
        private readonly string $beneficesSol,
        private readonly string $periodeOptimale,
        private readonly array $impactNutrients = [],
    ) {}

    public function getCulture(): string
    {
        return $this->culture;
    }

    public function getFamille(): string
    {
        return $this->famille;
    }

    public function getScoreCompatibilite(): int
    {
        return max(0, min(100, $this->scoreCompatibilite));
    }

    public function getRaisonRecommandation(): string
    {
        return $this->raisonRecommandation;
    }

    public function getBeneficesSol(): string
    {
        return $this->beneficesSol;
    }

    public function getPeriodeOptimale(): string
    {
        return $this->periodeOptimale;
    }

    public function getImpactNutrients(): array
    {
        return $this->impactNutrients;
    }

    public function getScoreColor(): string
    {
        return match (true) {
            $this->scoreCompatibilite >= 75 => 'green',
            $this->scoreCompatibilite >= 50 => 'yellow',
            default => 'red',
        };
    }

    public function getScoreLabel(): string
    {
        return match (true) {
            $this->scoreCompatibilite >= 75 => 'Excellent',
            $this->scoreCompatibilite >= 50 => 'Bon',
            default => 'Faible',
        };
    }
}
