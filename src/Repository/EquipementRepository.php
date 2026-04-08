<?php

namespace App\Repository;

use App\Entity\Equipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class EquipementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipement::class);
    }

    public function search(?string $nom = null, ?string $type = null, ?string $etat = null, ?string $sort = null, ?string $direction = null): array
    {
        $qb = $this->createQueryBuilder('e');

        // Filter by nom using LIKE
        if ($nom) {
            $qb->andWhere('e.nom LIKE :nom')
               ->setParameter('nom', '%' . $nom . '%');
        }

        // Filter by type
        if ($type) {
            $qb->andWhere('e.type = :type')
               ->setParameter('type', $type);
        }

        // Filter by etat
        if ($etat) {
            $qb->andWhere('e.etat = :etat')
               ->setParameter('etat', $etat);
        }

        // Dynamic sorting with validation
        $validSortColumns = ['nom', 'type', 'etat'];
        $validDirections = ['ASC', 'DESC'];

        if ($sort && in_array($sort, $validSortColumns)) {
            $sortDirection = $direction && in_array(strtoupper($direction), $validDirections) ? strtoupper($direction) : 'ASC';
            $qb->orderBy('e.' . $sort, $sortDirection);
        } else {
            // Default sorting by nom ASC
            $qb->orderBy('e.nom', 'ASC');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Get total count of equipement
     */
    public function countTotal(): int
    {
        return (int) $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Get count of available equipement
     */
    public function countAvailable(): int
    {
        return (int) $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->andWhere("LOWER(e.etat) = 'libre'")
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Get count of reserved equipement
     */
    public function countReserved(): int
    {
        return (int) $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->andWhere("LOWER(e.etat) = 'réservé'")
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Get equipement count grouped by type
     */
    public function groupByType(): array
    {
        return $this->createQueryBuilder('e')
            ->select('e.type, COUNT(e.id) as count')
            ->groupBy('e.type')
            ->orderBy('count', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
