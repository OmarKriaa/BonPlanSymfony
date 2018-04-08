<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion", indexes={@ORM\Index(name="IDX_C11D7DD1E2982ECA", columns={"Reduction_Valeur"})})
 * @ORM\Entity
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
     *
     * @ORM\Column(name="QRCode", type="string", length=255, nullable=false)
     */
    private $qrcode;

    /**
     * @var \Reduction
     *
     * @ORM\ManyToOne(targetEntity="Reduction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Reduction_Valeur", referencedColumnName="valeur")
     * })
     */
    private $reductionValeur;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Promotion
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Promotion
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Promotion
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Promotion
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Promotion
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Promotion
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
     * Set qrcode
     *
     * @param string $qrcode
     *
     * @return Promotion
     */
    public function setQrcode($qrcode)
    {
        $this->qrcode = $qrcode;

        return $this;
    }

    /**
     * Get qrcode
     *
     * @return string
     */
    public function getQrcode()
    {
        return $this->qrcode;
    }

    /**
     * Set reductionValeur
     *
     * @param \BonPlanBundle\Entity\Reduction $reductionValeur
     *
     * @return Promotion
     */
    public function setReductionValeur(\BonPlanBundle\Entity\Reduction $reductionValeur = null)
    {
        $this->reductionValeur = $reductionValeur;

        return $this;
    }

    /**
     * Get reductionValeur
     *
     * @return \BonPlanBundle\Entity\Reduction
     */
    public function getReductionValeur()
    {
        return $this->reductionValeur;
    }
}
