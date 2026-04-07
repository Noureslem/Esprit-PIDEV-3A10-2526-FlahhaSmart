<?php

namespace App\Controller;

use App\Service\StatisticsService;
use App\Service\OperationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
final class DashboardController extends AbstractController
{
    #[Route('', name: 'app_dashboard_index', methods: ['GET'])]
    public function index(StatisticsService $statisticsService): Response
    {
        $statistics = $statisticsService->getDashboardStatistics();
        $upcomingOperations = $statisticsService->formatUpcomingOperationsForApi(3);

        return $this->render('backend/dashboard/index.html.twig', [
            'statistics' => $statistics,
            'operationsSummary' => $statisticsService->getOperationsSummary($statistics),
            'equipementUsageData' => $statisticsService->getEquipementUsageData($statistics),
            'upcomingOperations' => $upcomingOperations,
        ]);
    }

    #[Route('/api/statistics', name: 'app_dashboard_api_statistics', methods: ['GET'])]
    public function apiStatistics(StatisticsService $statisticsService): JsonResponse
    {
        $statistics = $statisticsService->getDashboardStatistics();
        $upcomingOperations = $statisticsService->formatUpcomingOperationsForApi(3);
        
        // Get properly formatted data for charts
        $equipmentUsageData = $statisticsService->getEquipementUsageData($statistics);

        $data = $statistics->toArray();
        // Replace the usage percentages with properly formatted chart data
        $data['charts']['equipementUsage'] = $equipmentUsageData;

        return $this->json([
            'success' => true,
            'data' => array_merge(
                $data,
                ['upcomingOperations' => $upcomingOperations]
            ),
            'timestamp' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);
    }

    #[Route('/api/operations/{id}/terminate', name: 'app_dashboard_operation_terminate', methods: ['POST'])]
    public function terminateOperation(int $id, OperationService $operationService): JsonResponse
    {
        try {
            $operation = $operationService->terminateOperation($id);

            return $this->json([
                'success' => true,
                'message' => 'Opération terminée avec succès',
                'operation' => [
                    'id' => $operation->getId(),
                    'typeOperation' => $operation->getTypeOperation(),
                    'statut' => $operation->getStatut(),
                ],
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}