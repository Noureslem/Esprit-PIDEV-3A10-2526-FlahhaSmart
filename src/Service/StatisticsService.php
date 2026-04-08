<?php

namespace App\Service;

use App\DTO\DashboardStatisticsDTO;
use App\Repository\EquipementRepository;
use App\Repository\OperationRepository;

class StatisticsService
{
    public function __construct(
        private OperationRepository $operationRepository,
        private EquipementRepository $equipementRepository,
        private OperationService $operationService,
    ) {}

    /**
     * Calculate all dashboard statistics
     */
    public function getDashboardStatistics(): DashboardStatisticsDTO
    {
        // Count operations
        $totalOperations = $this->operationRepository->countTotal();
        $operationsInProgress = $this->operationRepository->countInProgress();
        $operationsCompleted = $this->operationRepository->countCompleted();

        // Calculate completion rate
        $completionRate = $totalOperations > 0 ? ($operationsCompleted / $totalOperations) * 100 : 0;

        // Count equipement
        $totalEquipement = $this->equipementRepository->countTotal();
        $equipementAvailable = $this->equipementRepository->countAvailable();
        $equipementReserved = $this->equipementRepository->countReserved();

        // Calculate equipement usage percentages
        $equipementUsagePercentage = $this->calculateEquipementUsagePercentage(
            $totalEquipement,
            $equipementAvailable,
            $equipementReserved
        );

        // Get equipement by type for pie chart
        $equipementByType = $this->formatEquipementByType(
            $this->equipementRepository->groupByType()
        );

        return new DashboardStatisticsDTO(
            totalOperations: $totalOperations,
            operationsInProgress: $operationsInProgress,
            operationsCompleted: $operationsCompleted,
            totalEquipement: $totalEquipement,
            equipementAvailable: $equipementAvailable,
            equipementReserved: $equipementReserved,
            equipementByType: $equipementByType,
            equipementUsagePercentage: $equipementUsagePercentage,
            operationCompletionRate: $completionRate,
        );
    }

    /**
     * Calculate equipement usage percentage
     */
    private function calculateEquipementUsagePercentage(int $total, int $available, int $reserved): array
    {
        if ($total === 0) {
            return [
                'available' => 0,
                'reserved' => 0,
            ];
        }

        return [
            'available' => round(($available / $total) * 100, 2),
            'reserved' => round(($reserved / $total) * 100, 2),
        ];
    }

    /**
     * Format equipement by type for charts
     */
    private function formatEquipementByType(array $rawData): array
    {
        $formatted = [
            'labels' => [],
            'data' => [],
            'backgroundColor' => [
                '#10b981',
                '#34d399',
                '#6ee7b7',
                '#a7f3d0',
                '#d1fae5',
                '#ecfdf5',
            ],
        ];

        foreach ($rawData as $item) {
            $formatted['labels'][] = $item['type'] ?? 'Non défini';
            $formatted['data'][] = (int) $item['count'];
        }

        return $formatted;
    }

    /**
     * Get equipement usage data for donut chart
     */
    public function getEquipementUsageData(DashboardStatisticsDTO $statistics): array
    {
        return [
            'labels' => ['Disponible', 'Réservé'],
            'data' => [
                $statistics->equipementAvailable,
                $statistics->equipementReserved,
            ],
            'backgroundColor' => ['#10b981', '#ef4444'],
            'borderColor' => ['#ffffff', '#ffffff'],
            'borderWidth' => 2,
        ];
    }

    /**
     * Get operations summary for KPI
     */
    public function getOperationsSummary(DashboardStatisticsDTO $statistics): array
    {
        return [
            'total' => $statistics->totalOperations,
            'inProgress' => $statistics->operationsInProgress,
            'completed' => $statistics->operationsCompleted,
            'completionRate' => round($statistics->operationCompletionRate, 1),
        ];
    }

    /**
     * Get equipement summary for KPI
     */
    public function getEquipementSummary(DashboardStatisticsDTO $statistics): array
    {
        return [
            'total' => $statistics->totalEquipement,
            'available' => $statistics->equipementAvailable,
            'reserved' => $statistics->equipementReserved,
            'utilizationRate' => $statistics->totalEquipement > 0 
                ? round(($statistics->equipementReserved / $statistics->totalEquipement) * 100, 1)
                : 0,
        ];
    }

    /**
     * Get upcoming operations with days remaining
     */
    public function getUpcomingOperationsWithDaysRemaining(int $limit = 3): array
    {
        $operations = $this->operationService->getUpcomingOperations($limit);
        return $this->operationService->calculateDaysForOperations($operations);
    }

    /**
     * Format upcoming operations for API response
     */
    public function formatUpcomingOperationsForApi(int $limit = 3): array
    {
        $upcomingOps = $this->getUpcomingOperationsWithDaysRemaining($limit);
        $formatted = [];

        foreach ($upcomingOps as $item) {
            $operation = $item['operation'];
            $daysRemaining = $item['daysRemaining'];

            $formatted[] = [
                'id' => $operation->getId(),
                'typeOperation' => $operation->getTypeOperation(),
                'equipement' => $operation->getEquipement() ? $operation->getEquipement()->getNom() : 'N/A',
                'dateDebut' => $operation->getDateDebut()->format('d/m/Y'),
                'dateFin' => $operation->getDateFin()->format('d/m/Y'),
                'daysRemaining' => $daysRemaining,
                'statut' => $operation->getStatut(),
                'statusClass' => strtolower(str_replace([' ', 'é'], ['_', 'e'], $operation->getStatut())),
            ];
        }

        return $formatted;
    }
}
