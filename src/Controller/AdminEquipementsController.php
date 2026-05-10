<?php

namespace App\Controller;

use App\Repository\EquipementRepository;
use App\Repository\OperationRepository;
use App\Service\StatisticsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/equipements')]
class AdminEquipementsController extends AbstractController
{
    #[Route('', name: 'admin_equipements', methods: ['GET'])]
    public function index(
        Request $request,
        EquipementRepository $equipementRepository,
        OperationRepository $operationRepository,
        StatisticsService $statisticsService
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $search = trim((string) $request->query->get('q', ''));
        $type = $this->normalizeQueryString($request->query->get('type'));
        $etat = $this->normalizeQueryString($request->query->get('etat'));
        $sort = $this->normalizeQueryString($request->query->get('sort'));
        $direction = $this->normalizeQueryString($request->query->get('direction'));

        $page = max(1, (int) $request->query->get('page', 1));
        $limit = (int) $request->query->get('limit', 20);
        $limit = max(1, min(100, $limit));
        $offset = ($page - 1) * $limit;

        $equipements = $equipementRepository->searchAdmin(
            $search,
            $type,
            $etat,
            $sort,
            $direction,
            $limit,
            $offset
        );

        $total = $equipementRepository->countAdmin($search, $type, $etat);
        $totalPages = (int) ceil($total / $limit);

        $allTypes = $equipementRepository->createQueryBuilder('e')
            ->select('DISTINCT e.type')
            ->orderBy('e.type', 'ASC')
            ->setMaxResults(200)
            ->getQuery()
            ->getResult();

        $allEtats = $equipementRepository->createQueryBuilder('e')
            ->select('DISTINCT e.etat')
            ->orderBy('e.etat', 'ASC')
            ->setMaxResults(200)
            ->getQuery()
            ->getResult();

        $types = array_column($allTypes, 'type');
        $etats = array_column($allEtats, 'etat');

        $totalEquipement = $equipementRepository->countTotal();
        $equipementAvailable = $equipementRepository->countAvailable();
        $equipementReserved = $equipementRepository->countReserved();
        $equipementUnavailable = max(0, $totalEquipement - $equipementAvailable);
        $availabilityRate = $totalEquipement > 0
            ? round(($equipementAvailable / $totalEquipement) * 100, 1)
            : 0;

        $topUsed = $operationRepository->findTopEquipementUsage(5);
        $equipementIds = array_values(array_filter(array_map(
            static fn ($equipement) => $equipement?->getId(),
            $equipements
        )));
        $usageMap = $operationRepository->countByEquipementIds($equipementIds);

        $stateBreakdown = $equipementRepository->groupByEtat();
        $typeBreakdown = $equipementRepository->groupByType();

        $stateLabels = [];
        $stateCounts = [];
        foreach ($stateBreakdown as $row) {
            $stateLabels[] = $row['etat'] ?? 'Non defini';
            $stateCounts[] = (int) ($row['count'] ?? 0);
        }

        $typeLabels = [];
        $typeCounts = [];
        foreach ($typeBreakdown as $row) {
            $typeLabels[] = $row['type'] ?? 'Non defini';
            $typeCounts[] = (int) ($row['count'] ?? 0);
        }

        $charts = [
            'states' => [
                'labels' => $stateLabels,
                'data' => $stateCounts,
                'backgroundColor' => ['#10b981', '#f59e0b', '#ef4444', '#6366f1', '#94a3b8'],
            ],
            'types' => [
                'labels' => $typeLabels,
                'data' => $typeCounts,
                'backgroundColor' => ['#22c55e', '#38bdf8', '#f97316', '#a855f7', '#94a3b8'],
            ],
        ];

        return $this->render('admin/admin_equipements.html.twig', [
            'equipements' => $equipements,
            'usageMap' => $usageMap,
            'filters' => [
                'q' => $search,
                'type' => $type,
                'etat' => $etat,
                'sort' => $sort,
                'direction' => $direction,
                'limit' => $limit,
            ],
            'types' => $types,
            'etats' => $etats,
            'stats' => [
                'total' => $totalEquipement,
                'available' => $equipementAvailable,
                'reserved' => $equipementReserved,
                'unavailable' => $equipementUnavailable,
                'availabilityRate' => $availabilityRate,
            ],
            'charts' => $charts,
            'topUsed' => $topUsed,
            'pagination' => [
                'page' => $page,
                'totalPages' => max(1, $totalPages),
                'total' => $total,
                'limit' => $limit,
            ],
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
}
