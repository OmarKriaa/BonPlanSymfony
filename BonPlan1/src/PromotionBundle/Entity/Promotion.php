<?php

namespace PromotionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="PromotionBundle\Repository\PromotionRepository")
 */
class Promotion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;
    /**
     * @var string
     * @ORM\Column(name="QRCode", type="string", precision=10, scale=0, nullable=false)
     */
    private $QRCode;

    /**
     * @ORM\ManyToOne(targetEntity="Reduction")
     * @ORM\JoinColumn(name="Reduction_Valeur",referencedColumnName="valeur")
     */
    private $ValeurReduction;

    /**
     * @var integer
     *
     * @ORM\Column(name="valide", type="integer", nullable=false)
     */
    private $valide;

    /**
     * @return int
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param int $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }

    public function __toString()
    {
        return (string) $this->getValeurReduction();
    }

    public function __toInteger()
    {
        return (integer) $this->getValeurReduction();
    }

    public function __toInt()
    {
        return (int) $this->getValeurReduction();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return int
     */
    public function getQRCode()
    {
        return $this->QRCode;
    }

    /**
     * @param int $QRCode
     */
    public function setQRCode($QRCode)
    {
        $this->QRCode = $QRCode;
    }

    /**
     * @return mixed
     */
    public function getValeurReduction()
    {
        return $this->ValeurReduction;
    }

    /**
     * @param mixed $ValeurReduction
     */
    public function setValeurReduction($ValeurReduction)
    {
        $this->ValeurReduction = $ValeurReduction;
    }




}

