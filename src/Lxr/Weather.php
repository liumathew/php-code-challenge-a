<?php

namespace Lxr;


class Weather {
    private $city;
    /** @var  Weather\Temperature  $temperature */
    private $temperature;
    /** @var  Weather\Wind $wind*/
    private $wind;

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param \Lxr\Weather\Temperature $temperature
     * @return $this
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
     * @return $this
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