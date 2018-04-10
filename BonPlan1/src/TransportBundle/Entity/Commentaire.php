<?php

namespace TransportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="idTransport", columns={"idTransport"}), @ORM\Index(name="idPersonne", columns={"idPersonne"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @ORM\Column(name="champs", type="string", length=100, nullable=false)
     */
    private $champs;

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
     * @var \Transport
     *
     * @ORM\ManyToOne(targetEntity="Transport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTransport", referencedColumnName="idTransport")
     * })
     */
    private $idtransport;



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
     * Set champs
     *
     * @param string $champs
     *
     * @return Commentaire
     */
    public function setChamps($champs)
    {
        $this->champs = $champs;

        return $this;
    }

    /**
     * Get champs
     *
     * @return string
     */
    public function getChamps()
    {
        return $this->champs;
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

    /**
     * Set idtransport
     *
     * @param \TransportBundle\Entity\Transport $idtransport
     *
     * @return Commentaire
     */
    public function setIdtransport(\TransportBundle\Entity\Transport $idtransport = null)
    {
        $this->idtransport = $idtransport;

        return $this;
    }

    /**
     * Get idtransport
     *
     * @return \TransportBundle\Entity\Transport
     */
    public function getIdtransport()
    {
        return $this->idtransport;
    }
}
