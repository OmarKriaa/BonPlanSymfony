<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 21/03/2018
 * Time: 09:26
 */

namespace PartageExperienceBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="partageh")
 * @ORM\Entity(repositoryClass="PartageExperienceBundle\Repository\Avis")
 */

class PartageH
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idPartageH;

    /**
     * @ORM\Column(type="string")
     */
    protected $commentaireAvisH;
    /**
     * @ORM\Column(type="integer")
     */
    protected $NoteServiceH;
    /**
     * @ORM\Column(type="integer")
     */
    protected $NoteRapportH;
    /**
     * @ORM\Column(type="integer")
     */
    protected $NoteConfortH;
    /**
     * @ORM\Column(type="integer")
     */
    protected $NotePersonnelH;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $DateCommentaireH;

    /**
    * @ORM\Column(name="rating", type="integer",nullable=true)
    */
    protected $rating;
    /**
     * @ORM\ManyToOne(targetEntity="BonPlanBundle\Entity\Bonplan")
     * @ORM\JoinColumn(name="Bonplan_NomHotel",referencedColumnName="idBonPlan")
     */
    private $NomHotel;

    /**
     * @return mixed
     */
    public function getIdPartageH()
    {
        return $this->idPartageH;
    }

    /**
     * @return mixed
     */
    public function getCommentaireAvisH()
    {
        return $this->commentaireAvisH;
    }

    /**
     * @return mixed
     */
    public function getNoteServiceH()
    {
        return $this->NoteServiceH;
    }

    /**
     * @return mixed
     */
    public function getNoteRapportH()
    {
        return $this->NoteRapportH;
    }

    /**
     * @return mixed
     */
    public function getNoteConfortH()
    {
        return $this->NoteConfortH;
    }

    /**
     * @return mixed
     */
    public function getNotePersonnelH()
    {
        return $this->NotePersonnelH;
    }



    /**
     * @param mixed $idPartageH
     */
    public function setIdPartageH($idPartageH)
    {
        $this->idPartageH = $idPartageH;
    }

    /**
     * @param mixed $commentaireAvisH
     */
    public function setCommentaireAvisH($commentaireAvisH)
    {
        $this->commentaireAvisH = $commentaireAvisH;
    }

    /**
     * @param mixed $NoteServiceH
     */
    public function setNoteServiceH($NoteServiceH)
    {
        $this->NoteServiceH = $NoteServiceH;
    }

    /**
     * @param mixed $NoteRapportH
     */
    public function setNoteRapportH($NoteRapportH)
    {
        $this->NoteRapportH = $NoteRapportH;
    }

    /**
     * @param mixed $NoteConfortH
     */
    public function setNoteConfortH($NoteConfortH)
    {
        $this->NoteConfortH = $NoteConfortH;
    }

    /**
     * @param mixed $NotePersonnelH
     */
    public function setNotePersonnelH($NotePersonnelH)
    {
        $this->NotePersonnelH = $NotePersonnelH;
    }

    /**
     * @return mixed
     */
    public function getDateCommentaireH()
    {
        return $this->DateCommentaireH;
    }

    /**
     * @param mixed $DateCommentaireH
     */
    public function setDateCommentaireH($DateCommentaireH)
    {
        $this->DateCommentaireH = $DateCommentaireH;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getNomHotel()
    {
        return $this->NomHotel;
    }

    /**
     * @param mixed $NomHotel
     */
    public function setNomHotel($NomHotel)
    {
        $this->NomHotel = $NomHotel;
    }






}