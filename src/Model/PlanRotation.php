<?php

namespace App\Model;

/**
 * Représente un plan de rotation complet
 */
final class PlanRotation
{
    /**
     * @param array<int, string> $annees Indexées par année (0, 1, 2...)
     * @param int $scoreGlobal Score global du plan (0-100)
     * @param array<string, mixed> $metadata Métadonnées supplémentaires
     */
    public function __construct(
        private readonly array $annees,
        private readonly int $scoreGlobal,
        private readonly array $metadata = [],
    ) {}

    /**
     * @return array<int, string>
     */
    public function getAnnees(): array
    {
        return $this->annees;
    }

    public function getScoreGlobal(): int
    {
        return max(0, min(100, $this->scoreGlobal));
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function getCultureParAnnee(int $annee): ?string
    {
        return $this->annees[$annee] ?? null;
    }

    public function getDuree(): int
    {
        return count($this->annees);
    }

    public function hasBonhabit(): bool
    {
        return $this->getMetadata()['has_bonhabit'] ?? false;
    }

    public function getDiversite(): int
    {
        return count(array_unique($this->annees));
    }
}
