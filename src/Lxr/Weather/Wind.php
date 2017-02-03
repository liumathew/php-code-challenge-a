<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 02/02/17
 * Time: 8:54 AM
 */

namespace Lxr\Weather;


class Wind {
    /** @var  int speed */
    private $speed;
    /** @var  int direction */
    private $direction;

    /**
     * @param int $direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
        return $this;

    }

    /**
     * @return int
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param int $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }


}