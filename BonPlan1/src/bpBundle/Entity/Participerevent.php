<?php

namespace bpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participerevent
 *
 * @ORM\Table(name="participerevent", indexes={@ORM\Index(name="idEvent", columns={"idEvent", "idpersonne"}), @ORM\Index(name="idpersonne", columns={"idpersonne"}), @ORM\Index(name="IDX_128847C32C6A49BA", columns={"idEvent"})})
 * @ORM\Entity
 */
class Participerevent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idparticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvent", referencedColumnName="idEvent")
     * })
     */
    private $idevent;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpersonne", referencedColumnName="idPersonne")
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
     * Set idevent
     *
     * @param \bpBundle\Entity\Evenement $idevent
     *
     * @return Participerevent
     */
    public function setIdevent(\bpBundle\Entity\Evenement $idevent = null)
    {
        $this->idevent = $idevent;

        return $this;
    }

    /**
     * Get idevent
     *
     * @return \bpBundle\Entity\Evenement
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * Set idpersonne
     *
     * @param \bpBundle\Entity\Personne $idpersonne
     *
     * @return Participerevent
     */
    public function setIdpersonne(\bpBundle\Entity\Personne $idpersonne = null)
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * Get idpersonne
     *
     * @return \bpBundle\Entity\Personne
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }
}
