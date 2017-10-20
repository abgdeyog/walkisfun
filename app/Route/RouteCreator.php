<?php
namespace App\Route;
class RouteCreator
{
    private $places = array();
    private $path = array();
    private $location;
    private $destination;
    private $time;

    public function __construct(Location& $location, Place& $destination, &$places, &$time)
    {
        array_push($this->path, $location);
        $this->location = $location;
        $this->destination = $destination;
        $this->places = $places;
        $this->time = $time;
    }

    public function addPlace(Place& $place)
    {
        array_push($this->places, $place);
    }

    private function createRoute($time)
    {

    }
}