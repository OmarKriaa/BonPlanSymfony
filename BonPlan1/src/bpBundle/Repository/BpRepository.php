<?php
/**
 * Created by PhpStorm.
 * User: senda
 * Date: 29/03/2018
 * Time: 8:30 PM
 */

namespace bpBundle\Repository;
use Doctrine\ORM\EntityRepository;


class BpRepository extends EntityRepository
{
    public function findbp($nom,$ville)
    {
        //var_dump($id);
        $query=$this->getEntityManager()->createQuery("select b from bpBundle:Bonplan b
        where b.nom like :nom and b.ville like :ville")->setParameter('nom','%'.$nom.'%')->setParameter('ville','%'.$ville.'%');
        //var_dump($query->getResult());
        return $query->getResult();
    }

    public function valider($idbonplan)
    {
        $query=$this->getEntityManager()
            ->createQuery("UPDATE
        bpBundle:Bonplan m SET m.valide = :valid 
         WHERE m.idbonplan = :id");
        $query->setParameter('valid', '1');
        $query->setParameter('id', $idbonplan);
        $query->execute();
    }
    public function recherche8($prixMax,$prixMin)
    {
        $query= BpRepository::createQueryBuilder('r')
            ->where('r.prixnuit >= :prixMin ')
            ->andWhere('r.prixnuit <= :prixMax ')

            ->setParameters(array('prixMax'=>$prixMax,'prixMin'=>$prixMin))
            ->getQuery();
        return $query->getResult();
    }

    public function recherche12($prixMax)
    {
        $query= BpRepository::createQueryBuilder('r')
            ->where('r.prixnuit <= :prixMax ')
            ->setParameter('prixMax',$prixMax)
            ->getQuery();
        return $query->getResult();
    }
    public function recherche13($prixMin)
    {
        $query= BpRepository::createQueryBuilder('r')
            ->where('r.prixnuit >= :prixMin ')
            ->setParameter('prixMin',$prixMin)
            ->getQuery();
        return $query->getResult();
    }
}