<?php

declare(strict_types=1);

namespace App\DTO;

final class PlantNetAnalysisResultDTO
{
    /**
     * @param list<PlantNetSuggestionDTO> $suggestions
     * @param list<DiseaseDiagnosisDTO> $diseases
     */
    public function __construct(
        public ?PlantNetSuggestionDTO $bestMatch,
        public array $suggestions = [],
        public array $diseases = [],
        public ?int $remainingRequests = null,
        public ?string $apiVersion = null,
    ) {
    }

    /**
     * @return array{
     *   bestMatch:?array<string, mixed>,
     *   suggestions:list<array<string, mixed>>,
     *   diseases:list<array<string, mixed>>,
     *   remainingRequests:?int,
     *   apiVersion:?string
     * }
     */
    public function toArray(): array
    {
        return [
            'bestMatch' => $this->bestMatch?->toArray(),
            'suggestions' => array_map(
                static fn (PlantNetSuggestionDTO $item): array => $item->toArray(),
                $this->suggestions,
            ),
            'diseases' => array_map(
                static fn (DiseaseDiagnosisDTO $item): array => $item->toArray(),
                $this->diseases,
            ),
            'remainingRequests' => $this->remainingRequests,
            'apiVersion' => $this->apiVersion,
        ];
    }
}
