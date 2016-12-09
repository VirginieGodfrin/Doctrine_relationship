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

	/**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

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

    public function setRoles(array $roles) {

        $this->roles = $roles;

    }

    public function getRoles() {

        /*return ['ROLE_USER'];*/
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)) { 
            $roles[] = 'ROLE_USER';
        }
        return $roles;

    }
}