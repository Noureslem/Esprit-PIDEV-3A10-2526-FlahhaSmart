<?php

namespace App\Service;

use App\Entity\Notification as NotificationEntity;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Notifier\NotifierInterface;

class NotificationService
{
    public function __construct(
        private EntityManagerInterface $em,
        private MailService $mailService,
    ) {}

    public function create(int $userId, string $message, string $type): void
    {
        $user = $this->em->getRepository(Users::class)->find($userId);
        if (!$user) {
            return;
        }

        $notif = new NotificationEntity();
        $notif->setUser($user);
        $notif->setMessage($message);
        $notif->setType($type);
        $notif->setLu(false);
        $notif->setDateNotif(new \DateTime());
        $this->em->persist($notif);
        $this->em->flush();

        try {
            if ($user->getEmail()) {
                $this->mailService->sendNotificationEmail($user->getEmail(), $user->getNom() ?? 'Client', $message);
            }
        } catch (\Exception $e) {
            // Email non critique, on ignore l'erreur
        }
    }

    public function getUnreadCount(int $userId): int
    {
        return $this->em->getRepository(NotificationEntity::class)->count([
            'user' => $userId,
            'lu' => false,
        ]);
    }

    public function markAllAsRead(int $userId): void
    {
        $this->em->createQueryBuilder()
            ->update(NotificationEntity::class, 'n')
            ->set('n.lu', true)
            ->where('n.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->execute();
    }
}