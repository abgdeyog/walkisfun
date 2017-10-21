<?php
namespace App\Route;
class RouteCreator
{
    private $velocity = 5/60;
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
    //int time in minutes
    private function createRoute($time)
    {
        $maxRouteLegnth = $time*$this->velocity;
        $routeLength = Path::getPathLength($this->location, $this->destination);
        for($i = 0; $i < $this->places; $i++)
        {

        }
    }

    private function getDirectPathLength(Place& $places)
    {
        //todo
    }

    private function getPathLength(Place& $start, Place& $end)
    {
    //todo (some magic using google and some other shit)
        return 0;
    }
}