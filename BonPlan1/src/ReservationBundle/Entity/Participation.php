<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="idPersonne", columns={"idPersonne"}), @ORM\Index(name="idTransport", columns={"idTransport"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPersonne", type="integer", nullable=false)
     */
    private $idpersonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="idTransport", type="integer", nullable=false)
     */
    private $idtransport;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;


}

