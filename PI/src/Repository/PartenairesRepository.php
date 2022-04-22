<?php

namespace App\Repository;

use App\Entity\Partenaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Partenaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partenaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partenaires[]    findAll()
 * @method Partenaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partenaires::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Partenaires $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Partenaires $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function alphabet(){
    $entityManager=$this->getEntityManager();
    $query=$entityManager
        ->createQuery("SELECT p.nomP  FROM APP\Entity\Partenaires p JOIN  WHERE p.nomP=:name ")
        ->setParameter('name',$name);
        return $query->getSingleScalarResult();
}


   

    // /**
    //  * @return Partenaires[] Returns an array of Partenaires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Partenaires
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


   public function statfrontidqualite()
   {
   return $this->getEntityManager()
    
        ->createQuery("SELECT s.partenaire FROM APP\Entity\Stock2 s  WHERE  s.qualiteS='10' ")
      /*   ->createQuery("SELECT p.nomMarqueP FROM APP\Entity\Partenaires p") */
            ->getResult();
   }
   /* public function statfrontpartenaire()
   {
   return $this->getEntityManager()
    
        ->createQuery("SELECT p.nomMarqueP FROM APP\Entity\Partenaires p")
       
            ->getResult();
   } */


}
