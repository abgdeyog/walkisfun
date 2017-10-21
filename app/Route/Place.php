<?php

namespace App\Route;

class Place
{

    private $x;
    private $y;
    private $placeId;
    private $weight;

    protected $fillable = ['location', 'placeId', 'weight'];

    public function __construct($placeId)
    {
        $this->placeId = $placeId;
        $this->fetchLocation();//todo
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function setCoordinates($x, $y)
    {
        $this->location = new Location($x, $y);
    }

    public function description()
    {
        return $this->hasOne('App\PlaceDescription');
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getPlaceId()
    {
        return $this->placeId;
    }

    public function getWeight()
    {
        return $this->weight;
    }
}