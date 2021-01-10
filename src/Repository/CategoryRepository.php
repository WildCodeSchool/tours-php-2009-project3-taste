<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return int|mixed|string
     */
    public function findWithProducts()
    {
        $qb = $this->createQueryBuilder('c')
            ->addSelect('p')
            ->leftJoin('c.products', 'p')
            ->addOrderBy('c.id', 'asc')
            ->addOrderBy('p.groupName', 'asc')
            ->addOrderBy('p.id', 'asc')
            ->getQuery();
        return $qb->getResult();
    }
}
