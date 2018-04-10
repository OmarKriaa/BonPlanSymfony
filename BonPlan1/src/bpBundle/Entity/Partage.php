<?php

namespace bpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partage
 *
 * @ORM\Table(name="partage")
 * @ORM\Entity
 */
class Partage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPartage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpartage;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaireAvis", type="string", length=255, nullable=false)
     */
    private $commentaireavis;

    /**
     * @var integer
     *
     * @ORM\Column(name="NoteCuisine", type="integer", nullable=false)
     */
    private $notecuisine;

    /**
     * @var integer
     *
     * @ORM\Column(name="NoteRapport", type="integer", nullable=false)
     */
    private $noterapport;

    /**
     * @var integer
     *
     * @ORM\Column(name="NoteService", type="integer", nullable=false)
     */
    private $noteservice;

    /**
     * @var integer
     *
     * @ORM\Column(name="NoteAmbiance", type="integer", nullable=false)
     */
    private $noteambiance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCommentaire", type="date", nullable=false)
     */
    private $datecommentaire;



    /**
     * Get idpartage
     *
     * @return integer
     */
    public function getIdpartage()
    {
        return $this->idpartage;
    }

    /**
     * Set commentaireavis
     *
     * @param string $commentaireavis
     *
     * @return Partage
     */
    public function setCommentaireavis($commentaireavis)
    {
        $this->commentaireavis = $commentaireavis;

        return $this;
    }

    /**
     * Get commentaireavis
     *
     * @return string
     */
    public function getCommentaireavis()
    {
        return $this->commentaireavis;
    }

    /**
     * Set notecuisine
     *
     * @param integer $notecuisine
     *
     * @return Partage
     */
    public function setNotecuisine($notecuisine)
    {
        $this->notecuisine = $notecuisine;

        return $this;
    }

    /**
     * Get notecuisine
     *
     * @return integer
     */
    public function getNotecuisine()
    {
        return $this->notecuisine;
    }

    /**
     * Set noterapport
     *
     * @param integer $noterapport
     *
     * @return Partage
     */
    public function setNoterapport($noterapport)
    {
        $this->noterapport = $noterapport;

        return $this;
    }

    /**
     * Get noterapport
     *
     * @return integer
     */
    public function getNoterapport()
    {
        return $this->noterapport;
    }

    /**
     * Set noteservice
     *
     * @param integer $noteservice
     *
     * @return Partage
     */
    public function setNoteservice($noteservice)
    {
        $this->noteservice = $noteservice;

        return $this;
    }

    /**
     * Get noteservice
     *
     * @return integer
     */
    public function getNoteservice()
    {
        return $this->noteservice;
    }

    /**
     * Set noteambiance
     *
     * @param integer $noteambiance
     *
     * @return Partage
     */
    public function setNoteambiance($noteambiance)
    {
        $this->noteambiance = $noteambiance;

        return $this;
    }

    /**
     * Get noteambiance
     *
     * @return integer
     */
    public function getNoteambiance()
    {
        return $this->noteambiance;
    }

    /**
     * Set datecommentaire
     *
     * @param \DateTime $datecommentaire
     *
     * @return Partage
     */
    public function setDatecommentaire($datecommentaire)
    {
        $this->datecommentaire = $datecommentaire;

        return $this;
    }

    /**
     * Get datecommentaire
     *
     * @return \DateTime
     */
    public function getDatecommentaire()
    {
        return $this->datecommentaire;
    }
}
