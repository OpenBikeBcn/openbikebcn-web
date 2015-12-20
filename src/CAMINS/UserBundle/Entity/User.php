<?php
// src/CAMINS/UserBundle/Entity/User.php

namespace CAMINS\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;


/**
 * Usuari
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @var string
    *
    * @ORM\Column(name="userRole", type="string", length=255)
    */
    public $userRole;

    /**
     * @ORM\ManyToMany(targetEntity="OPENCITY\bikesBundle\Entity\Station", inversedBy="usersFavorites")
     * @ORM\JoinTable(name="users_favorites")
     */
    protected $myStations;

    /**
    * @ORM\OneToMany(targetEntity="OPENCITY\bikesBundle\Entity\Ruta", mappedBy="user")
    *
    */
    protected $myRoutes;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = array('ROLE_USER');
        $this->myStations = new ArrayCollection();
        $this->myRoutes = new ArrayCollection();
    }


    /**
     * Adds a FOS_USER Role to the User.
     * @throws Exception
     * @param Rol $rol
     */
    public function addRole( $rol )
    {
      	if($rol == 1) {
      	  array_push($this->roles, 'ROLE_MANAGER');
      	}
      	else if($rol == 2) {
      	  array_push($this->roles, 'ROLE_OPERATOR');
      	}
    }


  	/**
  	 * Returns the FOS_USER roles
  	 *
  	 * @return array The roles
  	 */
  	public function getRoles()
  	{
  		$roles = $this->roles;

  		foreach ($this->getGroups() as $group) {
  			$roles = array_merge($roles, $group->getRoles());
  		}

  		// we need to make sure to have at least one role
  		$roles[] = static::ROLE_DEFAULT;

  		return array_unique($roles);
  	}


    /**
    * Set userRole
    *
    * @param string $userRole
    * @return User
    */
    public function setUserRole($userRole)
    {
      $this->userRole = $userRole;
      return $this;
    }

    /**
    * Get userRole
    *
    * @return string
    */
    public function getUserRole()
    {
      return $this->userRole;
    }



    /**
    * Add Station as Favorite
    *
    * @param \OPENCITY\bikesBundle\Entity\Station $station
    * @return User
    */
    public function addMyStations(\OPENCITY\bikesBundle\Entity\Station $station)
    {
      $this->myStations[] = $station;
      return $this;
    }

    /**
    * Remove Station as Favorite
    *
    * @param \OPENCITY\bikesBundle\Entity\Station $station
    */
    public function removeMyStations(\OPENCITY\bikesBundle\Entity\Station $station)
    {
      $this->myStations->removeElement($station);
    }

    /**
    * Get mySstations
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getMyStations()
    {
      return $this->myStations;
    }

    /**
    * Add Ruta
    *
    * @param \OPENCITY\bikesBundle\Entity\Ruta $ruta
    * @return User
    */
    public function addMyRoutes(\OPENCITY\bikesBundle\Entity\Ruta $ruta)
    {
      $this->myRoutes[] = $ruta;
      return $this;
    }

    /**
    * Remove Ruta
    *
    * @param \OPENCITY\bikesBundle\Entity\Ruta $ruta
    */
    public function removeMyRoutes(\OPENCITY\bikesBundle\Entity\Ruta $ruta)
    {
      $this->myRoutes->removeElement($ruta);
    }

    /**
    * Get myRoutes
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getMyRoutes()
    {
      return $this->myRoutes;
    }

}
