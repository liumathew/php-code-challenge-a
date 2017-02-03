<?php

namespace Lxr\Weather;


class Temperature {
    /** @var  int current temperature in celcius */
    private $current;
    /** @var  int lowest temperature in celcius */
    private $low;
    /** @var  int highest temperature in celcius */
    private $high;

    /**
     * @param int $current
     * @return $this
     */
    public function setCurrent($current)
    {
        $this->current = $current;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param int $high
     * @return $this
     */
    public function setHigh($high)
    {
        $this->high = $high;
        return $this;
    }

    /**
     * @return int
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * @param int $low
     * @return $this
     */
    public function setLow($low)
    {
        $this->low = $low;
        return $this;
    }

    /**
     * @return int
     */
    public function getLow()
    {
        return $this->low;
    }


} 