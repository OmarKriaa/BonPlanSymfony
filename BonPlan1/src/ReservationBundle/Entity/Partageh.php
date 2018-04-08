<?php

namespace ReservationBundle\Entity;

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


}

