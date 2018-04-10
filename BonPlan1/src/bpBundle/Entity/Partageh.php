<?php

namespace bpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partageh
 *
 * @ORM\Table(name="partageh")
 * @ORM\Entity
 */
class Partageh
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPartageH", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpartageh;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaireAvisH", type="string", length=255, nullable=false)
     */
    private $commentaireavish;

    /**
     * @var integer
     *
     * @ORM\Column(name="NoteServiceH", type="integer", nullable=false)
     */
    private $noteserviceh;

    /**
     * @var integer
     *
     * @ORM\Column(name="NoteRapportH", type="integer", nullable=false)
     */
    private $noterapporth;

    /**
     * @var integer
     *
     * @ORM\Column(name="NoteConfortH", type="integer", nullable=false)
     */
    private $noteconforth;

    /**
     * @var integer
     *
     * @ORM\Column(name="NotePersonnelH", type="integer", nullable=false)
     */
    private $notepersonnelh;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCommentaireH", type="date", nullable=false)
     */
    private $datecommentaireh;



    /**
     * Get idpartageh
     *
     * @return integer
     */
    public function getIdpartageh()
    {
        return $this->idpartageh;
    }

    /**
     * Set commentaireavish
     *
     * @param string $commentaireavish
     *
     * @return Partageh
     */
    public function setCommentaireavish($commentaireavish)
    {
        $this->commentaireavish = $commentaireavish;

        return $this;
    }

    /**
     * Get commentaireavish
     *
     * @return string
     */
    public function getCommentaireavish()
    {
        return $this->commentaireavish;
    }

    /**
     * Set noteserviceh
     *
     * @param integer $noteserviceh
     *
     * @return Partageh
     */
    public function setNoteserviceh($noteserviceh)
    {
        $this->noteserviceh = $noteserviceh;

        return $this;
    }

    /**
     * Get noteserviceh
     *
     * @return integer
     */
    public function getNoteserviceh()
    {
        return $this->noteserviceh;
    }

    /**
     * Set noterapporth
     *
     * @param integer $noterapporth
     *
     * @return Partageh
     */
    public function setNoterapporth($noterapporth)
    {
        $this->noterapporth = $noterapporth;

        return $this;
    }

    /**
     * Get noterapporth
     *
     * @return integer
     */
    public function getNoterapporth()
    {
        return $this->noterapporth;
    }

    /**
     * Set noteconforth
     *
     * @param integer $noteconforth
     *
     * @return Partageh
     */
    public function setNoteconforth($noteconforth)
    {
        $this->noteconforth = $noteconforth;

        return $this;
    }

    /**
     * Get noteconforth
     *
     * @return integer
     */
    public function getNoteconforth()
    {
        return $this->noteconforth;
    }

    /**
     * Set notepersonnelh
     *
     * @param integer $notepersonnelh
     *
     * @return Partageh
     */
    public function setNotepersonnelh($notepersonnelh)
    {
        $this->notepersonnelh = $notepersonnelh;

        return $this;
    }

    /**
     * Get notepersonnelh
     *
     * @return integer
     */
    public function getNotepersonnelh()
    {
        return $this->notepersonnelh;
    }

    /**
     * Set datecommentaireh
     *
     * @param \DateTime $datecommentaireh
     *
     * @return Partageh
     */
    public function setDatecommentaireh($datecommentaireh)
    {
        $this->datecommentaireh = $datecommentaireh;

        return $this;
    }

    /**
     * Get datecommentaireh
     *
     * @return \DateTime
     */
    public function getDatecommentaireh()
    {
        return $this->datecommentaireh;
    }
}
