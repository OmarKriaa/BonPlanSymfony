<?php

namespace TransportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="idPersonne", columns={"idPersonne"}), @ORM\Index(name="idPersonne_2", columns={"idPersonne"})})
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
     * @ORM\Column(name="nbrPresonnes", type="integer", nullable=false)
     */
    private $nbrpresonnes;

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
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="idPersonne")
     * })
     */
    private $idpersonne;



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
     * Set nbrpresonnes
     *
     * @param integer $nbrpresonnes
     *
     * @return Reservation
     */
    public function setNbrpresonnes($nbrpresonnes)
    {
        $this->nbrpresonnes = $nbrpresonnes;

        return $this;
    }

    /**
     * Get nbrpresonnes
     *
     * @return integer
     */
    public function getNbrpresonnes()
    {
        return $this->nbrpresonnes;
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
     * Set prix
     *
     * @param float $prix
     *
     * @return Reservation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set idpersonne
     *
     * @param \TransportBundle\Entity\Personne $idpersonne
     *
     * @return Reservation
     */
    public function setIdpersonne(\TransportBundle\Entity\Personne $idpersonne = null)
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * Get idpersonne
     *
     * @return \TransportBundle\Entity\Personne
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }
}
