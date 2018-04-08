<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 27/03/2018
 * Time: 22:07
 */

namespace ReservationBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ReservationRepository extends EntityRepository
{
    public function maj($id)
    {
        $query = $this->getEntityManager()->createQuery("select a from ReservationBundle:Reservation a where a.idpersonne =:id order BY a.idreservation DESC  ")->setMaxResults(1)
            ->setParameter('id',$id);

        return  $query->getResult();
    }
    public function aa()
    {
        $query = $this->getEntityManager()->createQuery("select  a from ReservationBundle:Reservation a ");

        return  $query->getResult();
    }

}