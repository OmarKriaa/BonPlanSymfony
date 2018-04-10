<?php

namespace bpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="idPersonne", columns={"idPersonne"}), @ORM\Index(name="idPersonne_2", columns={"idPersonne"}), @ORM\Index(name="idPersonne_3", columns={"idPersonne"}), @ORM\Index(name="idPersonne_4", columns={"idPersonne"}), @ORM\Index(name="idPersonne_5", columns={"idPersonne"}), @ORM\Index(name="idPersonne_6", columns={"idPersonne"}), @ORM\Index(name="idPersonne_7", columns={"idPersonne"}), @ORM\Index(name="idBonPlan", columns={"idBonPlan"}), @ORM\Index(name="idBonPlan_2", columns={"idBonPlan"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrPersonnes", type="integer", nullable=true)
     */
    private $nbrpersonnes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEntree", type="date", nullable=false)
     */
    private $dateentree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSortie", type="date", nullable=false)
     */
    private $datesortie;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPersonne", type="integer", nullable=false)
     */
    private $idpersonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrChambre", type="integer", nullable=false)
     */
    private $nbrchambre;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrNuit", type="integer", nullable=false)
     */
    private $nbrnuit;

    /**
     * @var integer
     *
     * @ORM\Column(name="idBonPlan", type="integer", nullable=false)
     */
    private $idbonplan;



    /**
     * Get idreservation
     *
     * @return integer
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * Set nbrpersonnes
     *
     * @param integer $nbrpersonnes
     *
     * @return Reservation
     */
    public function setNbrpersonnes($nbrpersonnes)
    {
        $this->nbrpersonnes = $nbrpersonnes;

        return $this;
    }

    /**
     * Get nbrpersonnes
     *
     * @return integer
     */
    public function getNbrpersonnes()
    {
        return $this->nbrpersonnes;
    }

    /**
     * Set dateentree
     *
     * @param \DateTime $dateentree
     *
     * @return Reservation
     */
    public function setDateentree($dateentree)
    {
        $this->dateentree = $dateentree;

        return $this;
    }

    /**
     * Get dateentree
     *
     * @return \DateTime
     */
    public function getDateentree()
    {
        return $this->dateentree;
    }

    /**
     * Set datesortie
     *
     * @param \DateTime $datesortie
     *
     * @return Reservation
     */
    public function setDatesortie($datesortie)
    {
        $this->datesortie = $datesortie;

        return $this;
    }

    /**
     * Get datesortie
     *
     * @return \DateTime
     */
    public function getDatesortie()
    {
        return $this->datesortie;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Reservation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set idpersonne
     *
     * @param integer $idpersonne
     *
     * @return Reservation
     */
    public function setIdpersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * Get idpersonne
     *
     * @return integer
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }

    /**
     * Set nbrchambre
     *
     * @param integer $nbrchambre
     *
     * @return Reservation
     */
    public function setNbrchambre($nbrchambre)
    {
        $this->nbrchambre = $nbrchambre;

        return $this;
    }

    /**
     * Get nbrchambre
     *
     * @return integer
     */
    public function getNbrchambre()
    {
        return $this->nbrchambre;
    }

    /**
     * Set nbrnuit
     *
     * @param integer $nbrnuit
     *
     * @return Reservation
     */
    public function setNbrnuit($nbrnuit)
    {
        $this->nbrnuit = $nbrnuit;

        return $this;
    }

    /**
     * Get nbrnuit
     *
     * @return integer
     */
    public function getNbrnuit()
    {
        return $this->nbrnuit;
    }

    /**
     * Set idbonplan
     *
     * @param integer $idbonplan
     *
     * @return Reservation
     */
    public function setIdbonplan($idbonplan)
    {
        $this->idbonplan = $idbonplan;

        return $this;
    }

    /**
     * Get idbonplan
     *
     * @return integer
     */
    public function getIdbonplan()
    {
        return $this->idbonplan;
    }
}
