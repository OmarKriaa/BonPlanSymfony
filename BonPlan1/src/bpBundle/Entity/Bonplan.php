<?php

namespace bpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bonplan
 *
 * @ORM\Table(name="bonplan")
 * @ORM\Entity(repositoryClass="bpBundle\Repository\BpRepository")
 */
class Bonplan
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idBonPlan", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbonplan;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbreChambreDispo", type="integer", nullable=true)
     */
    private $nbrechambredispo;

    /**
     * @var integer
     *
     * @ORM\Column(name="prixNuit", type="integer", nullable=true)
     */
    private $prixnuit;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrePlace", type="integer", nullable=true)
     */
    private $nbreplace;

    /**
     * @var integer
     *
     * @ORM\Column(name="valide", type="integer", nullable=false)
     */
    private $valide;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPersonne", type="string", length=50, nullable=true)
     */
    private $emailpersonne;



    /**
     * Get idbonplan
     *
     * @return integer
     */
    public function getIdbonplan()
    {
        return $this->idbonplan;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Bonplan
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Bonplan
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Bonplan
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Bonplan
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Bonplan
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Bonplan
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
     * Set nbrechambredispo
     *
     * @param integer $nbrechambredispo
     *
     * @return Bonplan
     */
    public function setNbrechambredispo($nbrechambredispo)
    {
        $this->nbrechambredispo = $nbrechambredispo;

        return $this;
    }

    /**
     * Get nbrechambredispo
     *
     * @return integer
     */
    public function getNbrechambredispo()
    {
        return $this->nbrechambredispo;
    }

    /**
     * Set prixnuit
     *
     * @param integer $prixnuit
     *
     * @return Bonplan
     */
    public function setPrixnuit($prixnuit)
    {
        $this->prixnuit = $prixnuit;

        return $this;
    }

    /**
     * Get prixnuit
     *
     * @return integer
     */
    public function getPrixnuit()
    {
        return $this->prixnuit;
    }

    /**
     * Set nbreplace
     *
     * @param integer $nbreplace
     *
     * @return Bonplan
     */
    public function setNbreplace($nbreplace)
    {
        $this->nbreplace = $nbreplace;

        return $this;
    }

    /**
     * Get nbreplace
     *
     * @return integer
     */
    public function getNbreplace()
    {
        return $this->nbreplace;
    }

    /**
     * Set valide
     *
     * @param integer $valide
     *
     * @return Bonplan
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return integer
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set emailpersonne
     *
     * @param string $emailpersonne
     *
     * @return Bonplan
     */
    public function setEmailpersonne($emailpersonne)
    {
        $this->emailpersonne = $emailpersonne;

        return $this;
    }

    /**
     * Get emailpersonne
     *
     * @return string
     */
    public function getEmailpersonne()
    {
        return $this->emailpersonne;
    }
}
