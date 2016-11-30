<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
*
* @ORM\Entity()
*
*/
class Artiste extends User
{
	/**
     * @var string
     *
     * @ORM\Column(name="speudo", type="string", length=255)
     */

	protected $speudo;

	private $roles;

	/**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setSpeudo($speudo)
    {
        $this->speudo = $speudo;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getSpeudo()
    {
        return $this->speudo;
    }

    public function getRoles() {
        return ['ROLE_USER'];
    }
}