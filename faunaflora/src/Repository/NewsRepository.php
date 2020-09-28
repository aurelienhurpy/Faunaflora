<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, News::class);
    }

    // public function findBestAds($limit){

    //     return $this->createQueryBuilder('a')
    //                 ->select('a as annonce,AVG(c.rating) as avgRatings')
    //                 ->join('a.comments','c')
    //                 ->groupBy('a')
    //                 ->orderBy('avgRatings','DESC')
    //                 ->setMaxResults($limit)
    //                 ->getQuery()
    //                 ->getResult()
    //                 ;

    // }
    
}
