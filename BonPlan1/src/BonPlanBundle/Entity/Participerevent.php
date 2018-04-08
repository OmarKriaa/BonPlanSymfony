<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participerevent
 *
 * @ORM\Table(name="participerevent", indexes={@ORM\Index(name="idEvent", columns={"idEvent"}), @ORM\Index(name="idpersonne", columns={"idpersonne"})})
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
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpersonne", referencedColumnName="id")
     * })
     */
    private $idpersonne;

    /**
     * @return int
     */
    public function getIdparticipation()
    {
        return $this->idparticipation;
    }

    /**
     * @param int $idparticipation
     */
    public function setIdparticipation($idparticipation)
    {
        $this->idparticipation = $idparticipation;
    }

    /**
     * @return \Evenement
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * @param \Evenement $idevent
     */
    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
    }

    /**
     * @return \FosUser
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }

    /**
     * @param \FosUser $idpersonne
     */
    public function setIdpersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;
    }



}
