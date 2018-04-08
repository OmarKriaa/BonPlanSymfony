<?php
/**
 * Created by PhpStorm.
 * User: Asus Pc
 * Date: 25/03/2018
 * Time: 21:51
 */

namespace BonPlanBundle\Repository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;


class EvenementRepository extends EntityRepository
{
    public function findevent($titre)
    {
        $query=$this->getEntityManager()->createQuery("select m from BonPlanBundle:evenement m where m.titre like :titre")
            ->setParameter('titre','%'.$titre.'%');
        return $query->getResult();
    }
    public function participer($idevent)
    {
        $query = $this->getEntityManager()->createQuery("UPDATE BonPlanBundle:evenement e SET e.nbplace= e.nbplace-1 WHERE e.idevent= :idevent")
            ->setParameter("idevent",$idevent);
        $query->execute();
    }
    public function valide($idevent)
    {
        $query = $this->getEntityManager()->createQuery("UPDATE BonPlanBundle:evenement e SET e.valide= 1 WHERE e.idevent= :idevent")
            ->setParameter("idevent",$idevent);
        $query->execute();
    }
    public function annuler($idevent)
    {
        $query = $this->getEntityManager()->createQuery("UPDATE BonPlanBundle:evenement e SET e.nbplace= e.nbplace+1 WHERE e.idevent= :idevent")
            ->setParameter("idevent",$idevent);
        $query->execute();
    }
    public function findAjax($x){

        $query =$this->getEntityManager()
            ->createQuery("SELECT e FROM BonPlanBundle:evenement e WHERE e.titre LIKE :x ")
            ->setParameter("x", $x.'%');
        return $query->getResult();
    }



}