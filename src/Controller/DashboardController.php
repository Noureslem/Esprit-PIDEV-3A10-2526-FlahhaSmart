<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Thread;
use App\Entity\Notification;
use App\Entity\article\Order;
use App\Repository\OperationRepository;
use App\Repository\UsersRepository;
use App\Service\OperationService;
use App\Service\StatisticsService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Doctrine\ORM\EntityManagerInterface;
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
        UsersRepository $userRepository,
        StatisticsService $statisticsService,
        EntityManagerInterface $em
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statistics = $statisticsService->getDashboardStatistics();
        $users = $userRepository->findAll();
        $reportStats = $this->buildAdminReportStats($users);
        $weeklyRegistrations = $this->buildWeeklyRegistrations($users);
        $monthlyRegistrations = $this->buildMonthlyRegistrations($users);
        $roleDistribution = [
            'labels' => ['Admins', 'Agriculteurs', 'Clients'],
            'data' => [$reportStats['admins'], $reportStats['farmers'], $reportStats['clients']],
        ];
        $statusDistribution = [
            'labels' => ['Actifs', 'Inactifs'],
            'data' => [$reportStats['activeUsers'], $reportStats['inactiveUsers']],
        ];
        $notificationRepository = $em->getRepository(Notification::class);
        $notifications = method_exists($notificationRepository, 'findLatest') ? $notificationRepository->findLatest(5) : [];
        $unreadNotifications = method_exists($notificationRepository, 'findUnreadCount') ? $notificationRepository->findUnreadCount() : 0;

        return $this->render('dashboard/admin.html.twig', [
            'stats' => array_merge($reportStats, [
                'commandes' => $em->getRepository(Order::class)->count([]),
                'threads'   => $em->getRepository(Thread::class)->count([]),
            ]),
            'lastUsers' => $userRepository->findBy([], ['date_creation' => 'DESC'], 10),
            'statistics' => $statistics,
            'adminSidebar' => $statisticsService->getAdminSidebarCounts(),
            'weeklyRegistrations' => $weeklyRegistrations,
            'monthlyRegistrations' => $monthlyRegistrations,
            'roleDistribution' => $roleDistribution,
            'statusDistribution' => $statusDistribution,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    #[Route('/admin/report', name: 'dashboard_admin_report')]
    public function downloadAdminReport(UsersRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $users = $userRepository->findAll();
        $stats = $this->buildAdminReportStats($users);
        $weeklyRegistrations = $this->buildWeeklyRegistrations($users);
        $monthlyRegistrations = $this->buildMonthlyRegistrations($users);
        $generatedAt = new \DateTimeImmutable();
        $adminName = $this->getUser() instanceof Users ? $this->getUser()->getFullName() : 'Administrateur';
        $filename = sprintf('rapport-admin-%s.pdf', $generatedAt->format('Y-m-d_H-i'));

        $html = $this->renderView('dashboard/admin_report_pdf.html.twig', [
            'stats' => $stats,
            'weeklyRegistrations' => $weeklyRegistrations,
            'monthlyLabels' => $monthlyRegistrations['labels'],
            'monthlyData' => $monthlyRegistrations['data'],
            'adminName' => $adminName,
            'generatedAt' => $generatedAt,
            'siteName' => 'FlahaSmart',
        ]);

        $sanitizedHtml = iconv('UTF-8', 'UTF-8//IGNORE', $html);
        if ($sanitizedHtml !== false) {
            $html = $sanitizedHtml;
        }

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response(
            $dompdf->output(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
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
    public function agriculteur(OperationRepository $operationRepository, OperationService $operationService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_AGRICULTEUR');

        $user = $this->getUser();
        if (!$user instanceof Users || $user->getIdUser() === null) {
            throw $this->createAccessDeniedException('Utilisateur non authentifie.');
        }

        $operations = $operationRepository->search(null, null, 'date_debut', 'DESC', $user->getIdUser(), 20, 0);
        $closestOperations = $operationService->calculateDaysForOperations(
            $operationService->getUpcomingOperations(3, $user->getIdUser())
        );

        return $this->render('dashboard/agriculteur.html.twig', [
            'user'     => $user,
            'threads'  => [],
            'operations' => $operations,
            'closestOperations' => $closestOperations,
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

    private function buildAdminReportStats(array $users): array
    {
        $totalUsers = count($users);
        $activeUsers = count(array_filter($users, static fn (Users $user) => $user->isActif()));
        $inactiveUsers = $totalUsers - $activeUsers;
        $admins = count(array_filter($users, fn (Users $user) => in_array($user->getRole(), ['ADMINISTRATEUR', 'ROLE_ADMIN'], true)));
        $farmers = count(array_filter($users, fn (Users $user) => in_array($user->getRole(), ['AGRICULTEUR', 'ROLE_AGRICULTEUR'], true)));
        $clients = count(array_filter($users, fn (Users $user) => in_array($user->getRole(), ['CLIENT', 'ROLE_CLIENT'], true)));
        $newThisMonth = count(array_filter($users, function (Users $user): bool {
            $createdAt = $user->getDateCreation();
            if (!$createdAt) {
                return false;
            }

            return $createdAt->format('Y-m') === (new \DateTimeImmutable())->format('Y-m');
        }));

        return [
            'users' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'admins' => $admins,
            'farmers' => $farmers,
            'clients' => $clients,
            'newThisMonth' => $newThisMonth,
            'activeRate' => $totalUsers > 0 ? (int) round(($activeUsers / $totalUsers) * 100) : 0,
        ];
    }

    private function buildWeeklyRegistrations(array $users): array
    {
        $days = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = new \DateTimeImmutable("-{$i} days");
            $key = $date->format('Y-m-d');
            $days[$key] = $date->format('D');
            $counts[$key] = 0;
        }

        foreach ($users as $user) {
            if (!$user instanceof Users || !$user->getDateCreation()) {
                continue;
            }

            $key = $user->getDateCreation()->format('Y-m-d');
            if (array_key_exists($key, $counts)) {
                $counts[$key]++;
            }
        }

        return [
            'labels' => array_values($days),
            'data' => array_values($counts),
        ];
    }

    private function buildMonthlyRegistrations(array $users): array
    {
        $labels = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = new \DateTimeImmutable("first day of -{$i} month");
            $key = $date->format('Y-m');
            $labels[$key] = $date->format('M');
            $data[$key] = 0;
        }

        foreach ($users as $user) {
            if (!$user instanceof Users || !$user->getDateCreation()) {
                continue;
            }

            $key = $user->getDateCreation()->format('Y-m');
            if (array_key_exists($key, $data)) {
                $data[$key]++;
            }
        }

        return [
            'labels' => array_values($labels),
            'data' => array_values($data),
        ];
    }
}
