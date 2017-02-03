<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 02/02/17
 * Time: 8:51 AM
 */

namespace Lxr;


class Weather {
    private $city;
    /** @var  Weather\Temperature  $temperature */
    private $temperature;
    /** @var  Weather\Wind $wind*/
    private $wind;

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param \Lxr\Weather\Temperature $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * @return \Lxr\Weather\Temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param \Lxr\Weather\Wind $wind
     */
    public function setWind($wind)
    {
        $this->wind = $wind;
        return $this;
    }

    /**
     * @return \Lxr\Weather\Wind
     */
    public function getWind()
    {
        return $this->wind;
    }


} 