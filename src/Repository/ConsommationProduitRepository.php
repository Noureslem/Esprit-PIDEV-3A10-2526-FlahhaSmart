<?php

namespace App\Repository;

use App\Entity\ConsommationProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConsommationProduit>
 *
 * @method ConsommationProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsommationProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsommationProduit[]    findAll()
 * @method ConsommationProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsommationProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsommationProduit::class);
    }
}
