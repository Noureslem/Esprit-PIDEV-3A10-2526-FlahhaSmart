<?php

namespace App\Repository;

use App\Entity\StockProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockProduit>
 *
 * @method StockProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockProduit[]    findAll()
 * @method StockProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockProduit::class);
    }
}
