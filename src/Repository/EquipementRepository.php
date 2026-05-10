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

    public function search(
        ?string $nom = null,
        ?string $type = null,
        ?string $etat = null,
        ?string $sort = null,
        ?string $direction = null,
        ?int $limit = null,
        ?int $offset = null
    ): array
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

        if ($limit !== null && $limit > 0) {
            $qb->setMaxResults($limit);
        }

        if ($offset !== null && $offset > 0) {
            $qb->setFirstResult($offset);
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
    public function groupByType(int $limit = 50): array
    {
        return $this->createQueryBuilder('e')
            ->select('e.type, COUNT(e.id) as count')
            ->groupBy('e.type')
            ->orderBy('count', 'DESC')
            ->setMaxResults(max(1, $limit))
            ->getQuery()
            ->getResult();
    }

    /**
     * Build admin search query for equipement with advanced filters.
     */
    private function createAdminSearchQueryBuilder(
        ?string $search = null,
        ?string $type = null,
        ?string $etat = null,
        ?string $sort = null,
        ?string $direction = null,
    ): \Doctrine\ORM\QueryBuilder {
        $qb = $this->createQueryBuilder('e');

        if ($search) {
            $orX = $qb->expr()->orX(
                'e.nom LIKE :search',
                'e.type LIKE :search'
            );

            if (ctype_digit($search)) {
                $orX->add('e.id = :searchId');
                $qb->setParameter('searchId', (int) $search);
            }

            $qb->andWhere($orX)->setParameter('search', '%' . $search . '%');
        }

        if ($type) {
            $qb->andWhere('e.type = :type')->setParameter('type', $type);
        }

        if ($etat) {
            $qb->andWhere('e.etat = :etat')->setParameter('etat', $etat);
        }

        $validSortColumns = ['nom', 'type', 'etat'];
        $validDirections = ['ASC', 'DESC'];

        if ($sort && in_array($sort, $validSortColumns, true)) {
            $sortDirection = $direction && in_array(strtoupper($direction), $validDirections, true)
                ? strtoupper($direction)
                : 'ASC';
            $qb->orderBy('e.' . $sort, $sortDirection);
        } else {
            $qb->orderBy('e.nom', 'ASC');
        }

        return $qb;
    }

    /**
     * Search equipement for admin listing with pagination.
     *
     * @return list<Equipement>
     */
    public function searchAdmin(
        ?string $search = null,
        ?string $type = null,
        ?string $etat = null,
        ?string $sort = null,
        ?string $direction = null,
        int $limit = 20,
        int $offset = 0
    ): array {
        $qb = $this->createAdminSearchQueryBuilder($search, $type, $etat, $sort, $direction)
            ->setFirstResult(max(0, $offset))
            ->setMaxResults(max(1, $limit));

        return $qb->getQuery()->getResult();
    }

    /**
     * Count equipement for admin listing with filters.
     */
    public function countAdmin(
        ?string $search = null,
        ?string $type = null,
        ?string $etat = null
    ): int {
        $qb = $this->createAdminSearchQueryBuilder($search, $type, $etat, null, null)
            ->select('COUNT(DISTINCT e.id)');

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Count equipement by etat (case-insensitive).
     */
    public function countByEtat(string $etat): int
    {
        return (int) $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->andWhere('LOWER(e.etat) = :etat')
            ->setParameter('etat', strtolower($etat))
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Group equipement by etat for charts.
     */
    public function groupByEtat(int $limit = 50): array
    {
        return $this->createQueryBuilder('e')
            ->select('e.etat, COUNT(e.id) as count')
            ->groupBy('e.etat')
            ->orderBy('count', 'DESC')
            ->setMaxResults(max(1, $limit))
            ->getQuery()
            ->getResult();
    }
}
