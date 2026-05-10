<?php

namespace App\Controller;

use App\Repository\OperationRepository;
use App\Repository\UsersRepository;
use App\Service\OperationService;
use App\Service\StatisticsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/operations')]
class AdminOperationsController extends AbstractController
{
    #[Route('', name: 'admin_operations', methods: ['GET'])]
    public function index(
        Request $request,
        OperationRepository $operationRepository,
        UsersRepository $usersRepository,
        OperationService $operationService,
        StatisticsService $statisticsService
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $search = trim((string) $request->query->get('q', ''));
        $statut = $this->normalizeQueryString($request->query->get('statut'));
        $priority = $this->normalizeQueryString($request->query->get('priority'));
        $sort = $this->normalizeQueryString($request->query->get('sort'));
        $direction = $this->normalizeQueryString($request->query->get('direction'));

        if ($priority && !in_array($priority, ['critical', 'high', 'normal'], true)) {
            $priority = null;
        }

        $start = $this->parseDate($request->query->get('start'));
        $end = $this->parseDate($request->query->get('end'));

        $page = max(1, (int) $request->query->get('page', 1));
        $limit = (int) $request->query->get('limit', 20);
        $limit = max(1, min(100, $limit));
        $offset = ($page - 1) * $limit;

        $operations = $operationRepository->searchAdmin(
            $search,
            $statut,
            $priority,
            $start,
            $end,
            $sort,
            $direction,
            $limit,
            $offset
        );

        $total = $operationRepository->countAdmin($search, $statut, $priority, $start, $end);
        $totalPages = (int) ceil($total / $limit);

        $allStatuts = $operationRepository->createQueryBuilder('o')
            ->select('DISTINCT o.statut')
            ->orderBy('o.statut', 'ASC')
            ->setMaxResults(200)
            ->getQuery()
            ->getResult();

        $statuts = array_column($allStatuts, 'statut');

        $totalOperations = $operationRepository->countTotal();
        $operationsInProgress = $operationRepository->countInProgress();
        $operationsCompleted = $operationRepository->countCompleted();
        $operationsCritical = $operationRepository->countCritical(2);
        $successRate = $totalOperations > 0
            ? round(($operationsCompleted / $totalOperations) * 100, 1)
            : 0;
        $avgDurationDays = $operationRepository->getAverageDurationDays();
        $criticalRate = $totalOperations > 0
            ? round(($operationsCritical / $totalOperations) * 100, 1)
            : 0;
        $performance = max(0, round($successRate - ($criticalRate * 0.5), 1));

        $rawStatuses = $operationRepository->groupByStatut();
        $statusLabels = [];
        $statusCounts = [];
        $palette = ['#10b981', '#34d399', '#f59e0b', '#f97316', '#ef4444', '#94a3b8'];
        foreach ($rawStatuses as $index => $row) {
            $statusLabels[] = $row['statut'] ?? 'Non defini';
            $statusCounts[] = (int) ($row['count'] ?? 0);
        }

        $statusChart = [
            'labels' => $statusLabels,
            'data' => $statusCounts,
            'backgroundColor' => array_slice($palette, 0, max(1, count($statusLabels))),
        ];

        $upcomingOperations = $operationService->calculateDaysForOperations(
            $operationService->getUpcomingOperations(6)
        );
        $recentOperations = $operationRepository->findBy([], ['date_debut' => 'DESC'], 6);

        $operationMeta = [];
        foreach ($operations as $operation) {
            $daysRemaining = null;
            if ($operation->getDateFin()) {
                $daysRemaining = $operationService->getDaysRemaining($operation->getDateFin());
            }

            $rawStatus = (string) $operation->getStatut();
            $status = function_exists('mb_strtolower') ? mb_strtolower($rawStatus) : strtolower($rawStatus);
            $priorityKey = 'normal';
            $priorityLabel = 'Normale';

            if ($status === 'terminé') {
                $priorityKey = 'done';
                $priorityLabel = 'Terminee';
            } elseif ($daysRemaining !== null && $daysRemaining <= 2) {
                $priorityKey = 'critical';
                $priorityLabel = 'Critique';
            } elseif ($daysRemaining !== null && $daysRemaining <= 7) {
                $priorityKey = 'high';
                $priorityLabel = 'Haute';
            }

            $operationMeta[$operation->getId()] = [
                'daysRemaining' => $daysRemaining,
                'priority' => $priorityKey,
                'priorityLabel' => $priorityLabel,
            ];
        }

        $userNames = [];
        $userIds = array_values(array_unique(array_filter(array_map(
            static fn ($operation) => $operation?->getIdUser(),
            $operations
        ))));

        if ($userIds !== []) {
            $users = $usersRepository->createQueryBuilder('u')
                ->andWhere('u.id_user IN (:ids)')
                ->setParameter('ids', $userIds)
                ->getQuery()
                ->getResult();

            foreach ($users as $user) {
                $name = trim($user->getFullName());
                if ($name === '') {
                    $name = $user->getEmail() ?: ('Utilisateur #' . $user->getIdUser());
                }
                $userNames[$user->getIdUser()] = $name;
            }
        }

        return $this->render('admin/admin_operations.html.twig', [
            'operations' => $operations,
            'operationMeta' => $operationMeta,
            'filters' => [
                'q' => $search,
                'statut' => $statut,
                'priority' => $priority,
                'start' => $start ? $start->format('Y-m-d') : '',
                'end' => $end ? $end->format('Y-m-d') : '',
                'sort' => $sort,
                'direction' => $direction,
                'limit' => $limit,
            ],
            'statuts' => $statuts,
            'stats' => [
                'total' => $totalOperations,
                'inProgress' => $operationsInProgress,
                'completed' => $operationsCompleted,
                'critical' => $operationsCritical,
                'successRate' => $successRate,
                'avgDurationDays' => $avgDurationDays,
                'performance' => $performance,
            ],
            'charts' => [
                'status' => $statusChart,
            ],
            'upcomingOperations' => $upcomingOperations,
            'recentOperations' => $recentOperations,
            'pagination' => [
                'page' => $page,
                'totalPages' => max(1, $totalPages),
                'total' => $total,
                'limit' => $limit,
            ],
            'userNames' => $userNames,
            'adminSidebar' => $statisticsService->getAdminSidebarCounts(),
        ]);
    }

    private function normalizeQueryString(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $value = trim($value);
        return $value !== '' ? $value : null;
    }

    private function parseDate(mixed $value): ?\DateTimeImmutable
    {
        if (!is_string($value) || trim($value) === '') {
            return null;
        }

        $parsed = \DateTimeImmutable::createFromFormat('Y-m-d', trim($value));
        return $parsed instanceof \DateTimeImmutable ? $parsed : null;
    }
}
