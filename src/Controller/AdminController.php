<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Users;
use App\Form\AdminUserFormType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/dashboard/admin')]
class AdminController extends AbstractController
{
    #[Route('/users', name: 'admin_users')]
    public function users(Request $request, UsersRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $search = trim($request->query->get('search', ''));
        $role   = trim($request->query->get('role', ''));
        $status = $request->query->get('status', '');
        $page   = max(1, $request->query->getInt('page', 1));
        $limit  = 8;

        $qb = $repo->createQueryBuilder('u')
            ->orderBy('u.date_creation', 'DESC');   // ← date_creation au lieu de dateCreation

        if ($search !== '') {
            $qb->andWhere('u.nom LIKE :search OR u.prenom LIKE :search OR u.email LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }
        if ($role !== '') {
            $roles = $this->getRoleVariants($role);
            $qb->andWhere('u.role IN (:roles)')->setParameter('roles', $roles);
        }
        if ($status !== '') {
            $qb->andWhere('u.actif = :status')->setParameter('status', $status === 'actif');
        }

        // Total filtré
        $filteredTotal = (clone $qb)
            ->select('COUNT(u.id_user)')
            ->getQuery()
            ->getSingleScalarResult();

        $totalPages = max(1, (int) ceil($filteredTotal / $limit));
        $page = min($page, $totalPages);

        $users = $qb
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        // Statistiques globales
        $stats = [
            'total'        => $repo->count([]),
            'admins'       => $this->countUsersByRoles($repo, ['ADMINISTRATEUR', 'ROLE_ADMIN']),
            'agriculteurs' => $this->countUsersByRoles($repo, ['AGRICULTEUR', 'ROLE_AGRICULTEUR']),
            'clients'      => $this->countUsersByRoles($repo, ['CLIENT', 'ROLE_CLIENT']),
            'actifs'       => $repo->count(['actif' => true]),
            'inactifs'     => $repo->count(['actif' => false]),
        ];

        return $this->render('admin/users.html.twig', [
            'users'  => $users,
            'search' => $search,
            'role'   => $role,
            'status' => $status,
            'stats'  => $stats,
            'pagination' => [
                'page'  => $page,
                'limit' => $limit,
                'total' => $filteredTotal,
                'pages' => $totalPages,
            ],
        ]);
    }

    #[Route('/notifications', name: 'admin_notifications')]
    public function notifications(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $page  = max(1, $request->query->getInt('page', 1));
        $limit = 10;

        $repo = $em->getRepository(Notification::class);
        $qb = $repo->createQueryBuilder('n')
            ->orderBy('n.dateNotif', 'DESC');

        $total = (clone $qb)
            ->select('COUNT(n.idNotif)')
            ->getQuery()
            ->getSingleScalarResult();

        $totalPages = max(1, (int) ceil($total / $limit));
        $page = min($page, $totalPages);

        $notifications = $qb
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        $unreadCount = $repo->createQueryBuilder('n')
            ->select('COUNT(n.idNotif)')
            ->andWhere('n.lu = :lu')
            ->setParameter('lu', false)
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('admin/notifications.html.twig', [
            'notifications' => $notifications,
            'unreadCount'   => (int) $unreadCount,
            'pagination'    => [
                'page'  => $page,
                'limit' => $limit,
                'total' => $total,
                'pages' => $totalPages,
            ],
        ]);
    }

    #[Route('/users/new', name: 'admin_user_new')]
    public function newUser(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = new Users();
        $form = $this->createForm(AdminUserFormType::class, $user, ['is_new' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setPassword($hasher->hashPassword($user, $plainPassword));
            $em->persist($user);
            $em->flush();

            $notification = new Notification();
            $notification->setMessage(sprintf(
                'Nouveau compte administrateur créé : %s %s (%s)',
                $user->getPrenom(),
                $user->getNom(),
                $user->getEmail()
            ));
            $notification->setType('user_registration');
            $notification->setLu(false);
            $notification->setDateNotif(new \DateTime());
            if (method_exists($notification, 'setLink')) {
                $notification->setLink($this->generateUrl('admin_users'));
            }
            $em->persist($notification);
            $em->flush();

            $this->addFlash('success', 'Utilisateur créé avec succès !');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/user_form.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Ajouter un utilisateur',
            'user'  => null,
        ]);
    }

    #[Route('/users/{id}/edit', name: 'admin_user_edit')]
    public function editUser(
        int $id,
        Request $request,
        UsersRepository $repo,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $repo->find($id);
        if (!$user) {
            $this->addFlash('error', 'Utilisateur introuvable.');
            return $this->redirectToRoute('admin_users');
        }

        $form = $this->createForm(AdminUserFormType::class, $user, ['is_new' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            if (!empty($plainPassword)) {
                $user->setPassword($hasher->hashPassword($user, $plainPassword));
            }
            $em->flush();
            $this->addFlash('success', 'Utilisateur modifié avec succès !');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/user_form.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Modifier ' . ($user->getPrenom() . ' ' . $user->getNom()),
            'user'  => $user,
        ]);
    }

    #[Route('/users/{id}/toggle', name: 'admin_user_toggle', methods: ['POST'])]
    public function toggleUser(int $id, UsersRepository $repo, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $repo->find($id);
        if ($user) {
            $user->setActif(!$user->isActif());
            $em->flush();
            $this->addFlash('success', 'Statut mis à jour.');
        } else {
            $this->addFlash('error', 'Utilisateur introuvable.');
        }
        return $this->redirectToRoute('admin_users');
    }

    #[Route('/users/{id}/delete', name: 'admin_user_delete', methods: ['POST'])]
    public function deleteUser(int $id, UsersRepository $repo, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $repo->find($id);
        if (!$user) {
            $this->addFlash('error', 'Utilisateur introuvable.');
            return $this->redirectToRoute('admin_users');
        }

        if ($user->getEmail() === $this->getUser()->getUserIdentifier()) {
            $this->addFlash('error', 'Vous ne pouvez pas supprimer votre propre compte.');
            return $this->redirectToRoute('admin_users');
        }

        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Utilisateur supprimé.');
        return $this->redirectToRoute('admin_users');
    }

    private function getRoleVariants(string $role): array
    {
        return match ($role) {
            'ADMINISTRATEUR', 'ROLE_ADMIN' => ['ADMINISTRATEUR', 'ROLE_ADMIN'],
            'AGRICULTEUR', 'ROLE_AGRICULTEUR' => ['AGRICULTEUR', 'ROLE_AGRICULTEUR'],
            'CLIENT', 'ROLE_CLIENT' => ['CLIENT', 'ROLE_CLIENT'],
            default => [$role],
        };
    }

    private function countUsersByRoles(UsersRepository $repo, array $roles): int
    {
        return (int) $repo->createQueryBuilder('u')
            ->select('COUNT(u.id_user)')
            ->andWhere('u.role IN (:roles)')
            ->setParameter('roles', $roles)
            ->getQuery()
            ->getSingleScalarResult();
    }
}