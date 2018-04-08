<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 05/04/2018
 * Time: 11:14
 */

namespace PromotionBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="Reduction")
 * @ORM\Entity
 */

class Reduction
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer",name="valeur")
     */
    private $Valeur;

    /**
     * @return mixed
     */
    public function getValeur()
    {
        return $this->Valeur;
    }

    /**
     * @param mixed $Valeur
     */
    public function setValeur($Valeur)
    {
        $this->Valeur = $Valeur;
    }
    public function __toString()
    {
        return (string) $this->getValeur();
    }

    public function toInt()
    {
        return (int) $this->getValeur();
    }


}