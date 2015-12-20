<?php

namespace OPENCITY\bikesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Ruta
 *
 * @ORM\Table()
 * @ORM\Entity
 * @JMS\ExclusionPolicy("all")
 */
class Ruta
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
     * @ORM\Column(name="duration", type="string", length=255)
     * @JMS\Expose
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="kilometers", type="string", length=255)
     * @JMS\Expose
     */
    private $kilometers;

    /**
    * @ORM\ManyToOne(targetEntity="Station", inversedBy="origins")
    * @ORM\JoinColumn(name="station_id_origin", referencedColumnName="id")
    * @JMS\Expose
    */
    protected $stationOrigin;

    /**
    * @ORM\ManyToOne(targetEntity="Station", inversedBy="arrivals")
    * @ORM\JoinColumn(name="station_id_arrivals", referencedColumnName="id")
    * @JMS\Expose
    */
    protected $stationArrival;

    /**
    * @ORM\ManyToOne(targetEntity="CAMINS\UserBundle\Entity\User", inversedBy="myRoutes")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    protected $user;

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
     * Set user
     *
     * @param string $duration
     *
     * @return Ruta
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Ruta
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set kilometers
     *
     * @param string $kilometers
     *
     * @return Ruta
     */
    public function setKilometers($kilometers)
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    /**
     * Get kilometers
     *
     * @return string
     */
    public function getKilometers()
    {
        return $this->kilometers;
    }

    /**
    * Set stationOrigin
    *
    * @param \OPENCITY\bikesBundle\Entity\Station $station
    * @return Ruta
    */
    public function setStationOrigin(\OPENCITY\bikesBundle\Entity\Station $station = null)
    {
      $this->stationOrigin = $station;
      return $this;
    }

    /**
    * Get stationOrigin
    *
    * @return \OPENCITY\bikesBundle\Entity\Station
    */
    public function getStationOrigin()
    {
      return $this->stationOrigin;
    }

    /**
    * Set stationArrival
    *
    * @param \OPENCITY\bikesBundle\Entity\Station $station
    * @return Ruta
    */
    public function setStationArrival(\OPENCITY\bikesBundle\Entity\Station $station = null)
    {
      $this->stationArrival = $station;
      return $this;
    }

    /**
    * Get stationArrival
    *
    * @return \OPENCITY\bikesBundle\Entity\Station
    */
    public function getStationArrival()
    {
      return $this->stationArrival;
    }

    public function __toString()
    {
       return (string)$this->stationOrigin. " - ". $this->stationArrival;
    }

}
