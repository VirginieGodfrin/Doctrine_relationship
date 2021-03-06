<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Tags;
use AppBundle\Entity\Category;
use AppBundle\Entity\Event;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Band
 *
 * @ORM\Table(name="band")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BandRepository")
 */
class Band
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
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @ORM\OneToMany(targetEntity="Category", mappedBy="band",)
     */

    private $categories;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="bands", cascade={"persist"})
     * @ORM\joinTable(name="band_tags")
     */
    private $tags;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="bands")
     */
    private $events;

    public function __construct(){
        $this->tags = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->events = new ArrayCollection();
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
     * @return Band
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
     * @return ArrayCollection\Categories[]
     *
     */
    public function getCategories(){
        return $this->categories;    
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Band
     */
    public function addCategory(Category $category = null)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\tags $tags
     *
     * @return Band
     */
    public function addTags(Tags $tags)
    {
        
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \AppBundle\Entity\tags $tags
     */
    public function removeTags(Tags $tags)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return ArrayCollection\Tags[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    
    /**
     * Add event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return Band
     */
    public function addEvent(Event $event = null)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \AppBundle\Entity\Event $event
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }


}
