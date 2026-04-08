<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\StatisticsService;
use App\Service\OperationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('', name: 'app_dashboard')]
    #[Route('', name: 'app_dashboard_index')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_admin');
        }
        if ($this->isGranted('ROLE_AGRICULTEUR')) {
            return $this->redirectToRoute('dashboard_agriculteur');
        }

        return $this->redirectToRoute('dashboard_client');
    }

    #[Route('/admin', name: 'dashboard_admin')]
    public function admin(
        UserRepository $userRepository,
        StatisticsService $statisticsService
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statistics = $statisticsService->getDashboardStatistics();

        return $this->render('dashboard/admin.html.twig', [
            'stats' => [
                'users'     => $userRepository->count([]),
                'articles'  => 0,
                'commandes' => 0,
                'threads'   => 0,
            ],
            'lastUsers' => $userRepository->findBy([], ['date_creation' => 'DESC'], 10),
            'statistics' => $statistics,
        ]);
    }

    #[Route('/client', name: 'dashboard_client')]
    public function client(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        return $this->render('dashboard/client.html.twig', [
            'user'      => $this->getUser(),
            'commandes' => [],
        ]);
    }

    #[Route('/agriculteur', name: 'dashboard_agriculteur')]
    public function agriculteur(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_AGRICULTEUR');

        return $this->render('dashboard/agriculteur.html.twig', [
            'user'     => $this->getUser(),
            'articles' => [],
            'threads'  => [],
        ]);
    }

    #[Route('/api/statistics', name: 'app_dashboard_api_statistics', methods: ['GET'])]
    public function apiStatistics(StatisticsService $statisticsService): JsonResponse
    {
        $statistics = $statisticsService->getDashboardStatistics();
        $upcomingOperations = $statisticsService->formatUpcomingOperationsForApi(3);

        $data = $statistics->toArray();
        $data['charts']['equipementUsage'] = $statisticsService->getEquipementUsageData($statistics);

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