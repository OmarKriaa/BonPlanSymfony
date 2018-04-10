<?php

namespace bpBundle\Entity;

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
     * @ORM\Column(name="idPersonne", type="integer", nullable=false)
     */
    private $idpersonne;

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
     * Get idparticipation
     *
     * @return integer
     */
    public function getIdparticipation()
    {
        return $this->idparticipation;
    }

    /**
     * Set idpersonne
     *
     * @param integer $idpersonne
     *
     * @return Participation
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
}
