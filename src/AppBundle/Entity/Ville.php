<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\ConcertHall;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VilleRepository")
 */
class Ville
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
     * @ORM\ManyToOne(targetEntity="ConcertHall")
     * @ORM\JoinColumn(name="concert_hall_id", referencedColumnName="id")
     */
    private $concertHall;


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
     * @return Ville
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
     * Set concertHall
     *
     * @param \AppBundle\Entity\ConcertHall $concertHall
     *
     * @return Ville
     */
    public function setConcertHall(ConcertHall $concertHall)
    {
        $this->concertHall = $concertHall;

        return $this;
    }

    /**
     * Get concertHall
     *
     * @return \AppBundle\Entity\ConcertHall
     */
    public function getConcertHall()
    {
        return $this->concertHall;
    }
}
