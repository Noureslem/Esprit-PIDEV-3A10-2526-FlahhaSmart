<?php
namespace App\Repository\article;

use App\Entity\article\Article;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

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