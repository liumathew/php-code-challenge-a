<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 02/02/17
 * Time: 8:53 AM
 */

namespace Lxr\Weather;


class Temperature {
    /** @var  int current temperature in celus */
    private $current;
    /** @var  int lowest temperature in celus */
    private $low;
    /** @var  int highest temperature in celus */
    private $high;

    /**
     * @param int $current
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