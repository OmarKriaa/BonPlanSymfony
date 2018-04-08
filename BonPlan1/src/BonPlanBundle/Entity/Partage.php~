<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partage
 *
 * @ORM\Table(name="partage", indexes={@ORM\Index(name="idBonPlan", columns={"idBonPlan"})})
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
     * @var \Bonplan
     *
     * @ORM\ManyToOne(targetEntity="Bonplan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBonPlan", referencedColumnName="idBonPlan")
     * })
     */
    private $idbonplan;


}

