<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use AppBundle\Entity\Band;


/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagsRepository")
 */
class Tags
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Band", mappedBy="tags")
     * 
     */
    private $bands;


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
     * @return Tags
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
     * Add band
     *
     * @param \AppBundle\Entity\Band $band
     *
     * @return Tags
     */
    public function addBand(Band $band)
    {
        $this->bands[] = $band;

        return $this;
    }

    /**
     * Remove band
     *
     * @param \AppBundle\Entity\Band $band
     */
    public function removeBand(Band $band)
    {
        $this->bands->removeElement($band);
    }

    /**
     * Get bands
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBands()
    {
        return $this->bands;
    }
}
