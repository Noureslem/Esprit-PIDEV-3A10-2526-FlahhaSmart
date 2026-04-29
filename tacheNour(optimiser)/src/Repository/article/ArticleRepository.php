<?php
namespace App\Repository\article;

use App\Entity\article\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;


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
     * Retourne les articles paginés, triés et filtrés.
     *
     * @param string $search   Terme de recherche (vide = tous)
     * @param string $sort     Critère de tri (utilisé côté PHP uniquement)
     * @param int    $page     Numéro de page (1‑based)
     * @param int    $limit    Nombre d'éléments par page
     * @return array{items: Article[], total: int} Les articles et le total sans limite
     */
    public function findPaginated(string $search = '', string $sort = 'id', int $page = 1, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('a');

        // Filtre de recherche
        if (!empty($search)) {
            $qb->where('LOWER(a.nom) LIKE LOWER(:term)')
               ->setParameter('term', '%' . $search . '%');
        }

        // On récupère d'abord le total avant d'appliquer la pagination
        $totalQb = clone $qb;
        $total = (int) $totalQb->select('COUNT(a.id)')->getQuery()->getSingleScalarResult();

        // Pagination
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