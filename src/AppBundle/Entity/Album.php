<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Band;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlbumRepository")
 */
class Album
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
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     * 
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="isPublish", type="boolean")
     * @Assert\NotBlank()
     */
    private $isPublish = true;

    /**
     * @ORM\ManyToOne(targetEntity="Band")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Album
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Album
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isPublish
     *
     * @param boolean $isPublish
     *
     * @return Album
     */
    public function setIsPublish($isPublish)
    {
        $this->isPublish = $isPublish;

        return $this;
    }

    /**
     * Get isPublish
     *
     * @return bool
     */
    public function getIsPublish()
    {
        return $this->isPublish;
    }

    public function getUpdatedAt(){
        return new \DateTime('-'.rand(0,100).'day');
    }

    /**
     * Set band
     *
     * @param \AppBundle\Entity\Band $band
     *
     * @return Album
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
