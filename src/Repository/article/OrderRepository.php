<?php
namespace App\Repository\article;

use App\Entity\article\Order;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function searchByReference(string $term): array
    {
        return $this->createQueryBuilder('o')
            ->where('LOWER(o.reference) LIKE LOWER(:term)')
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('o.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}