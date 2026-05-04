<?php
namespace App\Repository\article;

use App\Entity\article\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param int[] $ids
     * @return Article[]
     */
    public function findByIds(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }
        $qb = $this->createQueryBuilder('a');
        return $qb->where($qb->expr()->in('a.id', $ids))
                  ->getQuery()
                  ->getResult();
    }

    /**
     * @return array{items: Article[], total: int}
     */
    public function findPaginated(string $search = '', string $sort = 'id', int $page = 1, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('a');

        if (!empty($search)) {
            $qb->where('LOWER(a.nom) LIKE LOWER(:term)')
               ->setParameter('term', '%' . $search . '%');
        }

        $totalQb = clone $qb;
        $total = (int) $totalQb->select('COUNT(a.id)')->getQuery()->getSingleScalarResult();

        $offset = ($page - 1) * $limit;
        $qb->setFirstResult($offset)
           ->setMaxResults($limit);

        $items = $qb->getQuery()->getResult();

        return [
            'items' => $items,
            'total' => $total,
        ];
    }

    /**
     * @return Article[]
     */
    public function searchByName(string $term): array
    {
        return $this->createQueryBuilder('a')
            ->where('LOWER(a.nom) LIKE LOWER(:term)')
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}