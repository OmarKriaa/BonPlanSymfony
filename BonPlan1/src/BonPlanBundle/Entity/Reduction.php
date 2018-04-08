<?php

namespace BonPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reduction
 *
 * @ORM\Table(name="reduction")
 * @ORM\Entity
 */
class Reduction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="valeur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $valeur;



    /**
     * Get valeur
     *
     * @return integer
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}
