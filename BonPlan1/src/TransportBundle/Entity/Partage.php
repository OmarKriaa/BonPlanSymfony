<?php

namespace TransportBundle\Entity;

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
     * @ORM\Column(name="avis", type="string", length=255, nullable=false)
     */
    private $avis;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaireAvis", type="string", length=255, nullable=false)
     */
    private $commentaireavis;

    /**
     * @var integer
     *
     * @ORM\Column(name="Note", type="integer", nullable=false)
     */
    private $note;



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
     * Set avis
     *
     * @param string $avis
     *
     * @return Partage
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis
     *
     * @return string
     */
    public function getAvis()
    {
        return $this->avis;
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
     * Set note
     *
     * @param integer $note
     *
     * @return Partage
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }
}
