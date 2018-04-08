<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partageh
 *
 * @ORM\Table(name="partageh", indexes={@ORM\Index(name="IDX_3BEAD82681951C1D", columns={"Bonplan_NomHotel"})})
 * @ORM\Entity
 */
class Partageh
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_partage_h", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPartageH;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_service_h", type="integer", nullable=false)
     */
    private $noteServiceH;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_rapport_h", type="integer", nullable=false)
     */
    private $noteRapportH;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_confort_h", type="integer", nullable=false)
     */
    private $noteConfortH;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_personnel_h", type="integer", nullable=false)
     */
    private $notePersonnelH;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_avis_h", type="string", length=255, nullable=false)
     */
    private $commentaireAvisH;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commentaire_h", type="datetime", nullable=false)
     */
    private $dateCommentaireH;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="Bonplan_NomHotel", type="integer", nullable=true)
     */
    private $bonplanNomhotel;



    /**
     * Get idPartageH
     *
     * @return integer
     */
    public function getIdPartageH()
    {
        return $this->idPartageH;
    }

    /**
     * Set noteServiceH
     *
     * @param integer $noteServiceH
     *
     * @return Partageh
     */
    public function setNoteServiceH($noteServiceH)
    {
        $this->noteServiceH = $noteServiceH;

        return $this;
    }

    /**
     * Get noteServiceH
     *
     * @return integer
     */
    public function getNoteServiceH()
    {
        return $this->noteServiceH;
    }

    /**
     * Set noteRapportH
     *
     * @param integer $noteRapportH
     *
     * @return Partageh
     */
    public function setNoteRapportH($noteRapportH)
    {
        $this->noteRapportH = $noteRapportH;

        return $this;
    }

    /**
     * Get noteRapportH
     *
     * @return integer
     */
    public function getNoteRapportH()
    {
        return $this->noteRapportH;
    }

    /**
     * Set noteConfortH
     *
     * @param integer $noteConfortH
     *
     * @return Partageh
     */
    public function setNoteConfortH($noteConfortH)
    {
        $this->noteConfortH = $noteConfortH;

        return $this;
    }

    /**
     * Get noteConfortH
     *
     * @return integer
     */
    public function getNoteConfortH()
    {
        return $this->noteConfortH;
    }

    /**
     * Set notePersonnelH
     *
     * @param integer $notePersonnelH
     *
     * @return Partageh
     */
    public function setNotePersonnelH($notePersonnelH)
    {
        $this->notePersonnelH = $notePersonnelH;

        return $this;
    }

    /**
     * Get notePersonnelH
     *
     * @return integer
     */
    public function getNotePersonnelH()
    {
        return $this->notePersonnelH;
    }

    /**
     * Set commentaireAvisH
     *
     * @param string $commentaireAvisH
     *
     * @return Partageh
     */
    public function setCommentaireAvisH($commentaireAvisH)
    {
        $this->commentaireAvisH = $commentaireAvisH;

        return $this;
    }

    /**
     * Get commentaireAvisH
     *
     * @return string
     */
    public function getCommentaireAvisH()
    {
        return $this->commentaireAvisH;
    }

    /**
     * Set dateCommentaireH
     *
     * @param \DateTime $dateCommentaireH
     *
     * @return Partageh
     */
    public function setDateCommentaireH($dateCommentaireH)
    {
        $this->dateCommentaireH = $dateCommentaireH;

        return $this;
    }

    /**
     * Get dateCommentaireH
     *
     * @return \DateTime
     */
    public function getDateCommentaireH()
    {
        return $this->dateCommentaireH;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Partageh
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set bonplanNomhotel
     *
     * @param integer $bonplanNomhotel
     *
     * @return Partageh
     */
    public function setBonplanNomhotel($bonplanNomhotel)
    {
        $this->bonplanNomhotel = $bonplanNomhotel;

        return $this;
    }

    /**
     * Get bonplanNomhotel
     *
     * @return integer
     */
    public function getBonplanNomhotel()
    {
        return $this->bonplanNomhotel;
    }
}
