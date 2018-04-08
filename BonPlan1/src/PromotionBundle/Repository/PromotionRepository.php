<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 27/03/2018
 * Time: 13:45
 */

namespace PromotionBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PromotionRepository extends EntityRepository
{
    public function recherche8($prixMax,$prixMin)
    {
        $query= PromotionRepository::createQueryBuilder('r')
            ->where('r.prix >= :prixMin ')
            ->andWhere('r.prix <= :prixMax ')

            ->setParameters(array('prixMax'=>$prixMax,'prixMin'=>$prixMin))
            ->getQuery();
        return $query->getResult();
    }

    public function recherche12($prixMax)
    {
        $query= PromotionRepository::createQueryBuilder('r')
            ->where('r.prix <= :prixMax ')
            ->setParameter('prixMax',$prixMax)
            ->getQuery();
        return $query->getResult();
    }
    public function recherche13($prixMin)
    {
        $query= PromotionRepository::createQueryBuilder('r')
            ->where('r.prix >= :prixMin ')
            ->setParameter('prixMin',$prixMin)
            ->getQuery();
        return $query->getResult();
    }

    public function rechQR($qr)
    {
        $query= PromotionRepository::createQueryBuilder('r')
            ->where('r.QRCode = :QRCode ')
            ->setParameter('QRCode',$qr)
            ->getQuery();
        return $query->getResult();
    }

    public function valide($idPromotion)
    {
        $query = $this->getEntityManager()->createQuery("UPDATE PromotionBundle:Promotion e SET e.valide= 1 WHERE e.id= :id")
            ->setParameter("id",$idPromotion);
        $query->execute();
    }
}