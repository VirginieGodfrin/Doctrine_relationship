<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Band;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Band", inversedBy="categories", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $band;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
         $this->id = $id;
         return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString(){
        return $this->getName();
    }
    
    /**
     * Set band
     *
     * @param \AppBundle\Entity\Band $band
     *
     * @return Category
     */
    public function setBand(Band $band)
    {
        $this->band = $band;

        return $this;
    }

    /**
     * Get band
     *
     * @return \AppBundle\Entity\Band
     */
    public function getBand()
    {
        return $this->band;
    }
}
