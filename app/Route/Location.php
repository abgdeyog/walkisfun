<?php

namespace App\Route;

class Location
{
    private $x;
    private $y;

    function __construct($coordinateX, $coordinateY)
    {
        $this->x = $coordinateX;
        $this->y = $coordinateY;
    }

    function getX()
    {
        return $this->x;
    }

    function getY()
    {
        return $this->y;
    }
}