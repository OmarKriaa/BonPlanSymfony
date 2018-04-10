<?php

namespace TransportBundle\Entity;

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
     * @ORM\Column(name="idTransport", type="integer", nullable=false)
     */
    private $idtransport;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

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
     * Get idparticipation
     *
     * @return integer
     */
    public function getIdparticipation()
    {
        return $this->idparticipation;
    }

    /**
     * Set idtransport
     *
     * @param integer $idtransport
     *
     * @return Participation
     */
    public function setIdtransport($idtransport)
    {
        $this->idtransport = $idtransport;

        return $this;
    }

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
     * Set type
     *
     * @param string $type
     *
     * @return Participation
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
