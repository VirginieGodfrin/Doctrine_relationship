<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Band;
use AppBundle\Entity\ConcertHall;
use AppBundle\Entity\User;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stratTime", type="datetimetz")
     */
    private $stratTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="datetimetz")
     */
    private $endTime;


    /**
     * @ORM\ManyToMany(targetEntity="Band", inversedBy="events")
     */
    private $bands;

    /**
     * @ORM\ManyToOne(targetEntity="ConcertHall", inversedBy="events")
     */
    private $concertHall;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="events")
     */
    private $users;



    public function __construct(){

        $this->bands = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


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
     * @return Event
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
     * @return Event
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
     * Set stratTime
     *
     * @param \DateTime $stratTime
     *
     * @return Event
     */
    public function setStratTime($stratTime)
    {
        $this->stratTime = $stratTime;

        return $this;
    }

    /**
     * Get stratTime
     *
     * @return \DateTime
     */
    public function getStratTime()
    {
        return $this->stratTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Event
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Add band
     *
     * @param \AppBundle\Entity\Band $band
     *
     * @return Event
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

    /**
     * Set concertHall
     *
     * @param \AppBundle\Entity\ConcertHall $concertHall
     *
     * @return Event
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

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Event
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
