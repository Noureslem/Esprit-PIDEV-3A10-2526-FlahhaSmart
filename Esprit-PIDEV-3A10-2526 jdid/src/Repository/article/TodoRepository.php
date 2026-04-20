<?php
namespace App\Repository\article;

use App\Entity\article\Todo;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function findAllOrdered(): array
    {
        return $this->findBy([], ['nomTache' => 'ASC', 'tache' => 'ASC']);
    }

    public function findByNomTacheAndTache(string $nomTache, string $tache): ?Todo
    {
        return $this->findOneBy(['nomTache' => $nomTache, 'tache' => $tache]);
    }

    public function deleteByNomTacheAndTache(string $nomTache, string $tache): void
    {
        $this->createQueryBuilder('t')
            ->delete()
            ->where('t.nomTache = :nomTache AND t.tache = :tache')
            ->setParameter('nomTache', $nomTache)
            ->setParameter('tache', $tache)
            ->getQuery()
            ->execute();
    }
}