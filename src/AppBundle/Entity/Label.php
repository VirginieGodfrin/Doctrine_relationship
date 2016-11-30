<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
*
* @ORM\Entity()
*
*/
class Label extends User
{
	/**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */

	protected $titre;

	private $roles;

	/**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    public function getRoles() {
        return ['ROLE_USER'];
    }
}