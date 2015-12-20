<?php

namespace OPENCITY\bikesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;


/**
 * Station
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table()
 * @ORM\Entity

 */
class Station
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idBicing", type="string", length=255)
     * @JMS\Expose
     */
    private $idBicing;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @JMS\Expose
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     * @JMS\Expose
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     * @JMS\Expose
     */
    private $longitude;

    /**
    * @ORM\ManyToMany(targetEntity="CAMINS\UserBundle\Entity\User", mappedBy="myStations")
    */
    protected $usersFavorites;

    public function __construct()
    {
      $this->usersFavorites = new ArrayCollection();
    }



    /**
     * Get id
     *
     * @return integer
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
     * @return Station
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
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Station
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get latitude
     *
     * @return latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Station
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get longitude
     *
     * @return longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set idBicing
     *
     * @param integer $idBicing
     *
     * @return Station
     */
    public function setIdBicing($idBicing)
    {
        $this->idBicing = $idBicing;
        return $this;
    }

    /**
     * Get idBicing
     *
     * @return idBicing
     */
    public function getIdBicing()
    {
        return $this->idBicing;
    }

    /**
    * Add usersFavorite
    *
    * @param \CAMINS\UserBundle\Entity\User $user
    * @return Station
    */
    public function addUsersFavorites(\CAMINS\UserBundle\Entity\User $user)
    {
      $this->usersFavorites[] = $user;
      return $this;
    }

    /**
    * Remove usersFavorite
    *
    * @param \CAMINS\UserBundle\Entity\User $user
    */
    public function removeUsersFavorites(\CAMINS\UserBundle\Entity\User $user)
    {
      $this->usersFavorites->removeElement($user);
    }


     public function __toString()
     {
        return (string)$this->idBicing. " - ". $this->name;
     }

}
