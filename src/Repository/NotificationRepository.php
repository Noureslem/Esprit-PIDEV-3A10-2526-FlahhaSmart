<?php

namespace App\Repository;

use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\AsDoctrineRepository;

#[AsDoctrineRepository]
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function findLatest(int $limit = 5): array
    {
        return $this->createQueryBuilder('n')
            ->orderBy('n.dateNotif', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findUnreadCount(): int
    {
        return (int) $this->createQueryBuilder('n')
            ->select('COUNT(n.idNotif)')
            ->andWhere('n.lu = :read')
            ->setParameter('read', false)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
