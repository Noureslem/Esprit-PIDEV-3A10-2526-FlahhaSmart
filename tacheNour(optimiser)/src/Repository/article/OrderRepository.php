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

    /**
     * Retourne les commandes paginées, triées et filtrées.
     *
     * @param string $search   Terme de recherche (vide = tous)
     * @param string $sort     Critère de tri (utilisé côté PHP uniquement)
     * @param int    $page     Numéro de page (1‑based)
     * @param int    $limit    Nombre d'éléments par page
     * @return array{items: Order[], total: int}
     */
    public function findPaginated(string $search = '', string $sort = 'id', int $page = 1, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('o');

        // Filtre de recherche
        if (!empty($search)) {
            $qb->where('LOWER(o.reference) LIKE LOWER(:term)')
               ->setParameter('term', '%' . $search . '%');
        }

        // Total
        $totalQb = clone $qb;
        $total = (int) $totalQb->select('COUNT(o.id)')->getQuery()->getSingleScalarResult();

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
     * Ancienne méthode de recherche – conservée pour compatibilité éventuelle.
     */
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