<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 28/03/2018
 * Time: 09:22
 */

namespace PartageExperienceBundle\Repository;


use Doctrine\ORM\EntityRepository;

class Avis extends EntityRepository
{
     function findSerieDQL($date)
     {
         $q=$this->getEntityManager()
             ->createQuery("SELECT a FROM  PartageExperienceBundle:PartageH a WHERE a.DateCommentaireH= :DateCommentaireH")
             ->setParameter('DateCommentaireH',$date);
         return $q->getResult();
     }
}