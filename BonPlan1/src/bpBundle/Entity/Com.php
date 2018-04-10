<?php

namespace bpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Com
 *
 * @ORM\Table(name="com", indexes={@ORM\Index(name="idpersonne", columns={"idpersonne"}), @ORM\Index(name="idbonplan", columns={"idbonplan"})})
 * @ORM\Entity
 */
class Com
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcommentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @var \Bonplan
     *
     * @ORM\ManyToOne(targetEntity="Bonplan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idbonplan", referencedColumnName="idBonPlan")
     * })
     */
    private $idbonplan;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpersonne", referencedColumnName="id")
     * })
     */
    private $idpersonne;



    /**
     * Get idcommentaire
     *
     * @return integer
     */
    public function getIdcommentaire()
    {
        return $this->idcommentaire;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Com
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set idbonplan
     *
     * @param \bpBundle\Entity\Bonplan $idbonplan
     *
     * @return Com
     */
    public function setIdbonplan(\bpBundle\Entity\Bonplan $idbonplan = null)
    {
        $this->idbonplan = $idbonplan;

        return $this;
    }

    /**
     * Get idbonplan
     *
     * @return \bpBundle\Entity\Bonplan
     */
    public function getIdbonplan()
    {
        return $this->idbonplan;
    }

    /**
     * @param User $idpersonne
     */
    public function setIdpersonne($idpersonne )
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * @return User
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }
}
