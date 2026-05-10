<?php

declare(strict_types=1);

namespace App\DTO;

final class DiseaseDiagnosisDTO
{
    /**
     * @param list<string> $recommendations
     */
    public function __construct(
        public string $name,
        public float $confidence,
        public ?string $severity = null,
        public array $recommendations = [],
    ) {
    }

    /**
     * @return array{
     *   name:string,
     *   confidence:float,
     *   severity:?string,
     *   recommendations:list<string>
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'confidence' => $this->confidence,
            'severity' => $this->severity,
            'recommendations' => $this->recommendations,
        ];
    }
}
