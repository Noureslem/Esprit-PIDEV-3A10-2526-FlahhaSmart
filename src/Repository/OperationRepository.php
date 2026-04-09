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
     * @return Operation[] Returns an array of Operation objects
     */
    public function search(?string $type = null, ?string $statut = null, ?string $sort = null, ?string $direction = null, ?int $userId = null): array
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
}
