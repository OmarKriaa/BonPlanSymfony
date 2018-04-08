<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 *
 * @ORM\Table(name="transport", indexes={@ORM\Index(name="idClient", columns={"idPersonne"}), @ORM\Index(name="idTransport", columns={"idTransport"})})
 * @ORM\Entity
 */
class Transport
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTransport", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransport;

    /**
     * @var string
     *
     * @ORM\Column(name="villeDepart", type="string", length=50, nullable=false)
     */
    private $villedepart;

    /**
     * @var string
     *
     * @ORM\Column(name="villeArrive", type="string", length=50, nullable=false)
     */
    private $villearrive;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrPlaceDispo", type="integer", nullable=false)
     */
    private $nbrplacedispo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="date", nullable=false)
     */
    private $datedepart;

    /**
     * @var integer
     *
     * @ORM\Column(name="heureDepart", type="integer", nullable=false)
     */
    private $heuredepart;

    /**
     * @var integer
     *
     * @ORM\Column(name="heureArrivee", type="integer", nullable=false)
     */
    private $heurearrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPersonne", type="integer", nullable=false)
     */
    private $idpersonne;

    /**
     * @var float
     *
     * @ORM\Column(name="prixPersonne", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixpersonne;

    /**
     * @var float
     *
     * @ORM\Column(name="classLuxe", type="float", precision=10, scale=0, nullable=true)
     */
    private $classluxe;

    /**
     * @var float
     *
     * @ORM\Column(name="classEco", type="float", precision=10, scale=0, nullable=true)
     */
    private $classeco;


}

