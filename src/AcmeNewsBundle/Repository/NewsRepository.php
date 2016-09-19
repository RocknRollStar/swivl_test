<?php

namespace AcmeNewsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    public function getAllPublishedNews()
    {
        return $this->createQueryBuilder('n')
            ->select(['n'])
            ->where('n.published = 1')
            ->getQuery()
            ->getResult();
    }

    public function getRandomEntities($count = 10)
    {
        return  $this->createQueryBuilder('n')
            ->addSelect('RAND() as HIDDEN rand')
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }
}
