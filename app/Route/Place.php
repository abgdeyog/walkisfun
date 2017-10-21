<?php

namespace App\Route;

class Place
{

    private $gpsX;
    private $gpsY;
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
        return $this->gpsX;
    }

    public function getY()
    {
        return $this->gpsY;
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