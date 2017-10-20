<?php

namespace App\Route;

class Place
{

    private $location;
    private $name;
    private $weight;

    protected $fillable = ['location', 'name'];

    public function __construct($name, $coordinateX, $coordinateY)
    {
        $this->name = $name;
        $this->location = new Location($coordinateX, $coordinateY);
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
}