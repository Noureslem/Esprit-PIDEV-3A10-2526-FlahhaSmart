<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\PlantNetAnalysisResultDTO;
use App\DTO\PlantNetSuggestionDTO;

final class PlantNetResponseMapper
{
    public function map(array $identifyPayload): PlantNetAnalysisResultDTO
    {
        $suggestions = $this->mapSuggestions($identifyPayload);

        return new PlantNetAnalysisResultDTO(
            bestMatch: $suggestions[0] ?? null,
            suggestions: $suggestions,
            diseases: [],
            remainingRequests: isset($identifyPayload['remainingIdentificationRequests'])
                ? (int) $identifyPayload['remainingIdentificationRequests']
                : null,
            apiVersion: isset($identifyPayload['version']) ? (string) $identifyPayload['version'] : null,
        );
    }

    /**
     * @return list<PlantNetSuggestionDTO>
     */
    private function mapSuggestions(array $identifyPayload): array
    {
        $results = $identifyPayload['results'] ?? null;
        if (!is_array($results)) {
            return [];
        }

        $suggestions = [];

        foreach (array_slice($results, 0, 6) as $item) {
            if (!is_array($item)) {
                continue;
            }

            $species = $item['species'] ?? [];
            $species = is_array($species) ? $species : [];

            $family = $species['family'] ?? null;
            $family = is_array($family)
                ? (string) ($family['scientificNameWithoutAuthor'] ?? $family['scientificName'] ?? '')
                : (string) ($species['family'] ?? '');

            $genus = $species['genus'] ?? null;
            $genus = is_array($genus)
                ? (string) ($genus['scientificNameWithoutAuthor'] ?? $genus['scientificName'] ?? '')
                : (string) ($species['genus'] ?? '');

            $suggestions[] = new PlantNetSuggestionDTO(
                scientificName: (string) ($species['scientificNameWithoutAuthor'] ?? $species['scientificName'] ?? 'Espece inconnue'),
                commonNames: $this->extractCommonNames($species),
                score: (float) ($item['score'] ?? 0.0),
                family: trim($family) !== '' ? $family : 'N/A',
                genus: trim($genus) !== '' ? $genus : 'N/A',
                imageUrl: $this->extractImageUrl($item['images'] ?? null),
            );
        }

        return $suggestions;
    }

    /**
     * @return list<string>
     */
    private function extractCommonNames(array $species): array
    {
        $commonNames = $species['commonNames'] ?? [];
        if (!is_array($commonNames)) {
            return [];
        }

        $normalized = [];
        foreach ($commonNames as $name) {
            if (!is_string($name)) {
                continue;
            }

            $name = trim($name);
            if ($name === '') {
                continue;
            }

            $normalized[] = $name;
        }

        return array_values(array_unique($normalized));
    }

    private function extractImageUrl(mixed $images): ?string
    {
        if (!is_array($images) || $images === []) {
            return null;
        }

        $firstImage = $images[0] ?? null;
        if (!is_array($firstImage)) {
            return null;
        }

        $url = $firstImage['url'] ?? null;
        if (is_array($url)) {
            foreach (['m', 'o', 's'] as $size) {
                $candidate = trim((string) ($url[$size] ?? ''));
                if ($candidate !== '') {
                    return $candidate;
                }
            }
        }

        foreach (['large_url', 'medium_url', 'url'] as $key) {
            $candidate = trim((string) ($firstImage[$key] ?? ''));
            if ($candidate !== '') {
                return $candidate;
            }
        }

        return null;
    }
}
