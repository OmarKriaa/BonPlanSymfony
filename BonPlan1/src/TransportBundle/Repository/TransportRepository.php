<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 29/03/2018
 * Time: 20:51
 */

namespace TransportBundle\Repository;
use Doctrine\ORM\EntityRepository;


class TransportRepository extends EntityRepository
{
    public function valider($idtransport)
    {
        $query=$this->getEntityManager()
            ->createQuery("UPDATE
TransportBundle:Transport m SET m.validation = :valid 
WHERE m.idtransport = :id");
        $query->setParameter('valid', '1');
        $query->setParameter('id', $idtransport);
        $query->execute();
    }
    public function findcovoiturage($datedepart)
    {
        $q=$this->getEntityManager()
            ->createQuery("SELECT a FROM TransportBundle:Transport a WHERE a.datedepart=:datedepart")
            ->setParamter('datedepart',$datedepart);
            return $q->getResult();
    }
    public function chercher($datedepart,$villedepart,$villearrive)
    {
        $query=$this->getEntityManager()->createQuery("SELECT a FROM TransportBundle:Transport a 
    WHERE a.datedepart=:datedepart and a.villedepart=:villedepart and a.villearrive=:villearrive")
        ->setParameters(array('datedepart'=>$datedepart,
            'villedepart' => $villedepart,'villearrive'=>$villearrive)
        );
        return $query->getResult();
    }
}