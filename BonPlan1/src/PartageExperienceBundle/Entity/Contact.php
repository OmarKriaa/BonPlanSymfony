<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 22/03/2018
 * Time: 14:43
 */

namespace PartageExperienceBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="contact")
 */

class Contact
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    /**
     * @ORM\Column(type="string")
     */
    protected $comments;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCommentaire", type="datetime", nullable=false)
     */
    private $DateCommentaire;
    /**
     * @ORM\PrePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->DateCommentaire = date('Y-m-d');
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return \DateTime
     */
    public function getDateCommentaire()
    {
        return $this->DateCommentaire;
    }

    /**
     * @param \DateTime $DateCommentaire
     */
    public function setDateCommentaire($DateCommentaire)
    {
        $this->DateCommentaire = $DateCommentaire;
    }


}