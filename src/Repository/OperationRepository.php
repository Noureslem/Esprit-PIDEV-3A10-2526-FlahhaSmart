<?php

namespace App\Repository;

use App\Entity\Operation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Operation>
 */
class OperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operation::class);
    }

    /**
     * Search and filter operations with sorting
     *
     * @param string|null $type Filter by type_operation (LIKE)
     * @param string|null $statut Filter by statut (exact match)
     * @param string|null $sort Column to sort by (date_debut, date_fin, type_operation)
     * @param string|null $direction Sort direction (ASC, DESC)
    * @param int|null $userId Filter by owner user id
    * @param int|null $limit Max results
    * @param int|null $offset First result offset
     * @return Operation[] Returns an array of Operation objects
     */
    public function search(
        ?string $type = null,
        ?string $statut = null,
        ?string $sort = null,
        ?string $direction = null,
        ?int $userId = null,
        ?int $limit = null,
        ?int $offset = null
    ): array
    {
        $qb = $this->createQueryBuilder('o');

        if ($userId !== null) {
            $qb->andWhere('o.id_user = :userId')
               ->setParameter('userId', $userId);
        }

        // Filter by type_operation using LIKE
        if ($type) {
            $qb->andWhere('o.type_operation LIKE :type')
               ->setParameter('type', '%' . $type . '%');
        }

        // Filter by statut (exact match)
        if ($statut) {
            $qb->andWhere('o.statut = :statut')
               ->setParameter('statut', $statut);
        }

        // Dynamic sorting with validation
        $validSortColumns = ['type_operation', 'date_debut', 'date_fin'];
        $validDirections = ['ASC', 'DESC'];

        if ($sort && in_array($sort, $validSortColumns)) {
            $sortDirection = $direction && in_array(strtoupper($direction), $validDirections) ? strtoupper($direction) : 'ASC';
            $qb->orderBy('o.' . $sort, $sortDirection);
        } else {
            // Default sorting by date_debut DESC
            $qb->orderBy('o.date_debut', 'DESC');
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
     * Get total count of operations
     */
    public function countTotal(): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Get count of operations in progress
     */
    public function countInProgress(): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere("LOWER(o.statut) = 'en cours'")
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Get count of completed operations
     */
    public function countCompleted(): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere("LOWER(o.statut) = 'terminé'")
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Find upcoming operations ordered by date_fin
     * Excludes terminated operations and only keeps operations ending today or later
     */
    public function findUpcomingOperations(int $limit = 3, ?int $userId = null): array
    {
        $qb = $this->createQueryBuilder('o')
            ->andWhere("LOWER(o.statut) != 'terminé'")
            ->andWhere('o.date_fin >= :today')
            ->setParameter('today', new \DateTimeImmutable('today'))
            ->orderBy('o.date_fin', 'ASC')
            ->setMaxResults($limit);

        if ($userId !== null) {
            $qb->andWhere('o.id_user = :userId')
               ->setParameter('userId', $userId);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Find an operation with its equipment relation loaded
     */
    public function findWithEquipement(int $id): ?Operation
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.equipement', 'e')
            ->addSelect('e')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param list<int> $ids
     * @return list<Operation>
     */
    public function findWithEquipementsByIds(array $ids): array
    {
        if ($ids === []) {
            return [];
        }

        return $this->createQueryBuilder('o')
            ->leftJoin('o.equipement', 'e')
            ->addSelect('e')
            ->andWhere('o.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }

    /**
     * Build admin search query for operations with advanced filters.
     */
    private function createAdminSearchQueryBuilder(
        ?string $search = null,
        ?string $statut = null,
        ?string $priority = null,
        ?\DateTimeInterface $start = null,
        ?\DateTimeInterface $end = null,
        ?string $sort = null,
        ?string $direction = null,
    ): \Doctrine\ORM\QueryBuilder {
        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.equipement', 'e');

        if ($search) {
            $orX = $qb->expr()->orX(
                'o.type_operation LIKE :search',
                'e.nom LIKE :search'
            );

            if (ctype_digit($search)) {
                $orX->add('o.id = :searchId');
                $orX->add('o.id_user = :searchId');
                $qb->setParameter('searchId', (int) $search);
            }

            $qb->andWhere($orX)->setParameter('search', '%' . $search . '%');
        }

        if ($statut) {
            $qb->andWhere('o.statut = :statut')->setParameter('statut', $statut);
        }

        if ($start) {
            $qb->andWhere('o.date_debut >= :start')->setParameter('start', $start);
        }

        if ($end) {
            $qb->andWhere('o.date_fin <= :end')->setParameter('end', $end);
        }

        if ($priority) {
            $today = new \DateTimeImmutable('today');
            if ($priority === 'critical') {
                $qb->andWhere("LOWER(o.statut) != 'terminé'")
                   ->andWhere('o.date_fin <= :criticalLimit')
                   ->setParameter('criticalLimit', $today->modify('+2 days'));
            } elseif ($priority === 'high') {
                $qb->andWhere("LOWER(o.statut) != 'terminé'")
                   ->andWhere('o.date_fin > :criticalLimit')
                   ->andWhere('o.date_fin <= :highLimit')
                   ->setParameter('criticalLimit', $today->modify('+2 days'))
                   ->setParameter('highLimit', $today->modify('+7 days'));
            } elseif ($priority === 'normal') {
                $qb->andWhere("LOWER(o.statut) != 'terminé'")
                   ->andWhere('o.date_fin > :highLimit')
                   ->setParameter('highLimit', $today->modify('+7 days'));
            }
        }

        $validSortColumns = ['type_operation', 'date_debut', 'date_fin', 'statut'];
        $validDirections = ['ASC', 'DESC'];

        if ($sort && in_array($sort, $validSortColumns, true)) {
            $sortDirection = $direction && in_array(strtoupper($direction), $validDirections, true)
                ? strtoupper($direction)
                : 'ASC';
            $qb->orderBy('o.' . $sort, $sortDirection);
        } else {
            $qb->orderBy('o.date_debut', 'DESC');
        }

        return $qb;
    }

    /**
     * Search operations for admin listing with pagination.
     *
     * @return list<Operation>
     */
    public function searchAdmin(
        ?string $search = null,
        ?string $statut = null,
        ?string $priority = null,
        ?\DateTimeInterface $start = null,
        ?\DateTimeInterface $end = null,
        ?string $sort = null,
        ?string $direction = null,
        int $limit = 20,
        int $offset = 0
    ): array {
        $qb = $this->createAdminSearchQueryBuilder($search, $statut, $priority, $start, $end, $sort, $direction)
            ->addSelect('e')
            ->setFirstResult(max(0, $offset))
            ->setMaxResults(max(1, $limit));

        return $qb->getQuery()->getResult();
    }

    /**
     * Count operations for admin listing with filters.
     */
    public function countAdmin(
        ?string $search = null,
        ?string $statut = null,
        ?string $priority = null,
        ?\DateTimeInterface $start = null,
        ?\DateTimeInterface $end = null
    ): int {
        $qb = $this->createAdminSearchQueryBuilder($search, $statut, $priority, $start, $end, null, null)
            ->select('COUNT(DISTINCT o.id)');

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Count critical operations ending soon.
     */
    public function countCritical(int $daysThreshold = 2): int
    {
        $limitDate = (new \DateTimeImmutable('today'))->modify('+' . $daysThreshold . ' days');

        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere("LOWER(o.statut) != 'terminé'")
            ->andWhere('o.date_fin <= :limitDate')
            ->setParameter('limitDate', $limitDate)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Group operations by statut for charts.
     */
    public function groupByStatut(int $limit = 50): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.statut, COUNT(o.id) as count')
            ->groupBy('o.statut')
            ->orderBy('count', 'DESC')
            ->setMaxResults(max(1, $limit))
            ->getQuery()
            ->getResult();
    }

    /**
     * Average execution duration in days for completed operations.
     */
    public function getAverageDurationDays(): float
    {
        $rows = $this->createQueryBuilder('o')
            ->select('o.date_debut', 'o.date_fin')
            ->andWhere("LOWER(o.statut) = 'terminé'")
            ->getQuery()
            ->getArrayResult();

        if ($rows === []) {
            return 0.0;
        }

        $totalDays = 0;
        $count = 0;

        foreach ($rows as $row) {
            $start = $row['date_debut'] ?? null;
            $end = $row['date_fin'] ?? null;
            if (!$start || !$end) {
                continue;
            }

            $diff = $start->diff($end);
            $totalDays += (int) $diff->days;
            $count++;
        }

        return $count > 0 ? round($totalDays / $count, 1) : 0.0;
    }

    /**
     * Top equipment usage by number of operations.
     */
    public function findTopEquipementUsage(int $limit = 5): array
    {
        return $this->createQueryBuilder('o')
            ->select('e.id as id', 'e.nom as nom', 'COUNT(o.id) as usageCount')
            ->innerJoin('o.equipement', 'e')
            ->groupBy('e.id')
            ->orderBy('usageCount', 'DESC')
            ->setMaxResults(max(1, $limit))
            ->getQuery()
            ->getResult();
    }

    /**
     * Get operation counts grouped by equipement id.
     *
     * @param list<int> $equipementIds
     * @return array<int,int> map of equipementId => count
     */
    public function countByEquipementIds(array $equipementIds): array
    {
        if ($equipementIds === []) {
            return [];
        }

        $rows = $this->createQueryBuilder('o')
            ->select('IDENTITY(o.equipement) as equipement_id', 'COUNT(o.id) as count')
            ->andWhere('o.equipement IN (:ids)')
            ->setParameter('ids', $equipementIds)
            ->groupBy('equipement_id')
            ->getQuery()
            ->getResult();

        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row['equipement_id']] = (int) $row['count'];
        }

        return $map;
    }
}
