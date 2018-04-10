<?php

namespace TransportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 * @ORM\Entity(repositoryClass="TransportBundle\Repository\TransportRepository")
 * @ORM\Table(name="transport", indexes={@ORM\Index(name="idClient", columns={"idPersonne"}), @ORM\Index(name="idTransport", columns={"idTransport"})})
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
     * @var float
     *
     * @ORM\Column(name="prixPersonne", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixpersonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="validation", type="integer", nullable=false)
     */
    private $validation;

    /**
     * @var integer
     *
     * @ORM\Column(name="signalement", type="integer", nullable=false)
     */
    private $signalement;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdPersonne", referencedColumnName="id")
     * })
     */
    private $idpersonne;




    /**
     * Get idtransport
     *
     * @return integer
     */
    public function getIdtransport()
    {
        return $this->idtransport;
    }

    /**
     * Set villedepart
     *
     * @param string $villedepart
     *
     * @return Transport
     */
    public function setVilledepart($villedepart)
    {
        $this->villedepart = $villedepart;

        return $this;
    }

    /**
     * Get villedepart
     *
     * @return string
     */
    public function getVilledepart()
    {
        return $this->villedepart;
    }

    /**
     * Set villearrive
     *
     * @param string $villearrive
     *
     * @return Transport
     */
    public function setVillearrive($villearrive)
    {
        $this->villearrive = $villearrive;

        return $this;
    }

    /**
     * Get villearrive
     *
     * @return string
     */
    public function getVillearrive()
    {
        return $this->villearrive;
    }

    /**
     * Set nbrplacedispo
     *
     * @param integer $nbrplacedispo
     *
     * @return Transport
     */
    public function setNbrplacedispo($nbrplacedispo)
    {
        $this->nbrplacedispo = $nbrplacedispo;

        return $this;
    }

    /**
     * Get nbrplacedispo
     *
     * @return integer
     */
    public function getNbrplacedispo()
    {
        return $this->nbrplacedispo;
    }

    /**
     * Set datedepart
     *
     * @param \DateTime $datedepart
     *
     * @return Transport
     */
    public function setDatedepart($datedepart)
    {
        $this->datedepart = $datedepart;

        return $this;
    }

    /**
     * Get datedepart
     *
     * @return \DateTime
     */
    public function getDatedepart()
    {
        return $this->datedepart;
    }

    /**
     * Set heuredepart
     *
     * @param integer $heuredepart
     *
     * @return Transport
     */
    public function setHeuredepart($heuredepart)
    {
        $this->heuredepart = $heuredepart;

        return $this;
    }

    /**
     * Get heuredepart
     *
     * @return integer
     */
    public function getHeuredepart()
    {
        return $this->heuredepart;
    }

    /**
     * Set heurearrivee
     *
     * @param integer $heurearrivee
     *
     * @return Transport
     */
    public function setHeurearrivee($heurearrivee)
    {
        $this->heurearrivee = $heurearrivee;

        return $this;
    }

    /**
     * Get heurearrivee
     *
     * @return integer
     */
    public function getHeurearrivee()
    {
        return $this->heurearrivee;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Transport
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
     * Set prixpersonne
     *
     * @param float $prixpersonne
     *
     * @return Transport
     */
    public function setPrixpersonne($prixpersonne)
    {
        $this->prixpersonne = $prixpersonne;

        return $this;
    }

    /**
     * Get prixpersonne
     *
     * @return float
     */
    public function getPrixpersonne()
    {
        return $this->prixpersonne;
    }

    /**
     * Set validation
     *
     * @param integer $validation
     *
     * @return Transport
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return integer
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set signalement
     *
     * @param integer $signalement
     *
     * @return Transport
     */
    public function setSignalement($signalement)
    {
        $this->signalement = $signalement;

        return $this;
    }

    /**
     * Get signalement
     *
     * @return integer
     */
    public function getSignalement()
    {
        return $this->signalement;
    }



    /**
     * @return \User
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }

    /**
     * @param \User $idpersonne
     */
    public function setIdpersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;
    }
}
