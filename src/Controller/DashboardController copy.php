<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Users;
use Dompdf\Dompdf;
use Dompdf\Options;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $roles = $user->getRoles();

        if (in_array('ROLE_ADMIN', $roles)) {
            return $this->redirectToRoute('dashboard_admin');
        }
        if (in_array('ROLE_AGRICULTEUR', $roles)) {
            return $this->redirectToRoute('dashboard_agriculteur');
        }
        if (in_array('ROLE_CLIENT', $roles)) {
            return $this->redirectToRoute('dashboard_client');
        }

        return $this->redirectToRoute('dashboard_client');
    }

    #[Route('/dashboard/admin', name: 'dashboard_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function admin(EntityManagerInterface $em): Response
    {
        $userRepository = $em->getRepository(Users::class);
        $users = $userRepository->findAll();
        $stats = $this->buildAdminStats($users);
        $weeklyRegistrations = $this->buildWeeklyRegistrations($users);
        $monthlyRegistrations = $this->buildMonthlyRegistrations($users);
        $roleDistribution = $this->buildRoleDistribution($stats);
        $statusDistribution = $this->buildStatusDistribution($stats);

        $notificationRepository = $em->getRepository(Notification::class);
        $notifications = $notificationRepository->findLatest(5);
        $unreadNotifications = $notificationRepository->findUnreadCount();
        $totalNotifications = $notificationRepository->count([]);

        $stats['notifications'] = $totalNotifications;
        $stats['unreadNotifications'] = $unreadNotifications;

        $todayUsers = array_filter($users, function (Users $user): bool {
            if (!$user->getCreatedAt()) {
                return false;
            }

            return $user->getCreatedAt()->format('Y-m-d') === (new \DateTimeImmutable())->format('Y-m-d');
        });

        return $this->render('dashboard/admin.html.twig', [
            'stats' => $stats,
            'lastUsers' => $userRepository->findBy([], ['createdAt' => 'DESC'], 10),
            'weeklyRegistrations' => $weeklyRegistrations,
            'monthlyRegistrations' => $monthlyRegistrations,
            'roleDistribution' => $roleDistribution,
            'statusDistribution' => $statusDistribution,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
            'todayUsers' => $todayUsers,
        ]);
    }

    #[Route('/dashboard/admin/report', name: 'dashboard_admin_report')]
    #[IsGranted('ROLE_ADMIN')]
    public function downloadAdminReport(EntityManagerInterface $em): Response
    {
        $userRepository = $em->getRepository(Users::class);
        $users = $userRepository->findAll();
        $stats = $this->buildAdminStats($users);
        $weeklyRegistrations = $this->buildWeeklyRegistrations($users);
        $adminName = $this->getUser() instanceof Users ? $this->getUser()->getFullName() : 'Administrateur';
        $generatedAt = new \DateTimeImmutable();
        $filename = sprintf('rapport-statistiques-site-%s.pdf', $generatedAt->format('Y-m-d_H-i'));

        $html = $this->renderView('dashboard/admin_report_pdf.html.twig', [
            'stats' => $stats,
            'weeklyRegistrations' => $weeklyRegistrations,
            'adminName' => $adminName,
            'generatedAt' => $generatedAt,
            'siteName' => 'FlahaSmart',
        ]);

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
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

    #[Route('/dashboard/client', name: 'dashboard_client')]
    #[IsGranted('ROLE_CLIENT')]
    public function client(): Response
    {
        return $this->render('dashboard/client.html.twig', [
            'user'      => $this->getUser(),
            'commandes' => [],
        ]);
    }

    #[Route('/dashboard/agriculteur', name: 'dashboard_agriculteur')]
    #[IsGranted('ROLE_AGRICULTEUR')]
    public function agriculteur(): Response
    {
        return $this->render('dashboard/agriculteur.html.twig', [
            'user'     => $this->getUser(),
            'articles' => [],
            'threads'  => [],
        ]);
    }

    private function matchesRole(Users $user, array $roles): bool
    {
        return in_array($user->getRole(), $roles, true);
    }

    private function isInCurrentMonth(Users $user): bool
    {
        $createdAt = $user->getCreatedAt();
        if (!$createdAt) {
            return false;
        }

        $now = new \DateTimeImmutable();

        return $createdAt->format('Y-m') === $now->format('Y-m');
    }

    private function isActiveToday(Users $user): bool
    {
        $lastActivity = $user->getLastActivityAt();
        if (!$lastActivity) {
            return false;
        }

        $today = new \DateTimeImmutable('today');

        return $lastActivity >= $today;
    }

    private function isActiveThisWeek(Users $user): bool
    {
        $lastActivity = $user->getLastActivityAt();
        if (!$lastActivity) {
            return false;
        }

        $weekStart = new \DateTimeImmutable('monday this week');

        return $lastActivity >= $weekStart;
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
            if (!$user instanceof Users || !$user->getCreatedAt()) {
                continue;
            }

            $key = $user->getCreatedAt()->format('Y-m-d');
            if (array_key_exists($key, $counts)) {
                $counts[$key]++;
            }
        }

        return [
            'labels' => array_values($days),
            'data' => array_values($counts),
        ];
    }

    private function buildAdminStats(array $users): array
    {
        $totalUsers = count($users);
        $activeUsers = count(array_filter($users, static fn (Users $user) => $user->isActif()));
        $inactiveUsers = $totalUsers - $activeUsers;
        $adminUsers = count(array_filter($users, fn (Users $user) => $this->matchesRole($user, ['ADMINISTRATEUR', 'ROLE_ADMIN'])));
        $farmerUsers = count(array_filter($users, fn (Users $user) => $this->matchesRole($user, ['AGRICULTEUR', 'ROLE_AGRICULTEUR'])));
        $clientUsers = count(array_filter($users, fn (Users $user) => $this->matchesRole($user, ['CLIENT', 'ROLE_CLIENT'])));
        $newThisMonth = count(array_filter($users, fn (Users $user) => $this->isInCurrentMonth($user)));
        $activeToday = count(array_filter($users, fn (Users $user) => $this->isActiveToday($user)));
        $activeThisWeek = count(array_filter($users, fn (Users $user) => $this->isActiveThisWeek($user)));

        return [
            'users' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'admins' => $adminUsers,
            'farmers' => $farmerUsers,
            'clients' => $clientUsers,
            'newThisMonth' => $newThisMonth,
            'activeToday' => $activeToday,
            'activeThisWeek' => $activeThisWeek,
            'activeRate' => $totalUsers > 0 ? (int) round(($activeUsers / $totalUsers) * 100) : 0,
        ];
    }

    private function buildMonthlyRegistrations(array $users): array
    {
        $labels = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = new \DateTimeImmutable("first day of -{$i} month");
            $key = $date->format('Y-m');
            $labels[$key] = $date->format('M Y');
            $data[$key] = 0;
        }

        foreach ($users as $user) {
            if (!$user instanceof Users || !$user->getCreatedAt()) {
                continue;
            }

            $key = $user->getCreatedAt()->format('Y-m');
            if (array_key_exists($key, $data)) {
                $data[$key]++;
            }
        }

        return [
            'labels' => array_values($labels),
            'data' => array_values($data),
        ];
    }

    private function buildRoleDistribution(array $stats): array
    {
        return [
            'labels' => ['Admins', 'Agriculteurs', 'Clients'],
            'data' => [$stats['admins'], $stats['farmers'], $stats['clients']],
        ];
    }

    private function buildStatusDistribution(array $stats): array
    {
        return [
            'labels' => ['Actifs', 'Inactifs'],
            'data' => [$stats['activeUsers'], $stats['inactiveUsers']],
        ];
    }
}
