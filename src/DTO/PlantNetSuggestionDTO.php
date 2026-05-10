<?php

declare(strict_types=1);

namespace App\DTO;

final class PlantNetSuggestionDTO
{
    /**
     * @param list<string> $commonNames
     */
    public function __construct(
        public string $scientificName,
        public array $commonNames,
        public float $score,
        public string $family,
        public string $genus,
        public ?string $imageUrl = null,
    ) {
    }

    public function confidencePercent(): float
    {
        return round($this->score * 100, 2);
    }

    /**
     * @return array{
     *   scientificName:string,
     *   commonNames:list<string>,
     *   score:float,
     *   confidence:float,
     *   family:string,
     *   genus:string,
     *   imageUrl:?string
     * }
     */
    public function toArray(): array
    {
        return [
            'scientificName' => $this->scientificName,
            'commonNames' => $this->commonNames,
            'score' => $this->score,
            'confidence' => $this->confidencePercent(),
            'family' => $this->family,
            'genus' => $this->genus,
            'imageUrl' => $this->imageUrl,
        ];
    }
}
