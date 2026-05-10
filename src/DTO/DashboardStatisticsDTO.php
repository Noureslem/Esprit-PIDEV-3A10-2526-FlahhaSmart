<?php

namespace App\DTO;

class DashboardStatisticsDTO
{
    public function __construct(
        public int $totalOperations = 0,
        public int $operationsInProgress = 0,
        public int $operationsCompleted = 0,
        public int $totalEquipement = 0,
        public int $equipementAvailable = 0,
        public int $equipementReserved = 0,
        public array $equipementByType = [],
        public array $equipementUsagePercentage = [],
        public float $operationCompletionRate = 0.0,
    ) {}

    /**
     * Convert DTO to array for JSON serialization
     */
    public function toArray(): array
    {
        return [
            'operations' => [
                'total' => $this->totalOperations,
                'inProgress' => $this->operationsInProgress,
                'completed' => $this->operationsCompleted,
                'completionRate' => round($this->operationCompletionRate, 2),
            ],
            'equipement' => [
                'total' => $this->totalEquipement,
                'available' => $this->equipementAvailable,
                'reserved' => $this->equipementReserved,
            ],
            'charts' => [
                'equipementByType' => $this->equipementByType,
                'equipementUsage' => $this->equipementUsagePercentage,
            ],
        ];
    }
}
