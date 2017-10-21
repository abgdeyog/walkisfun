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

    public function __construct(Place& $location, Place& $destination, &$places, &$time)
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
        $maxRouteLength = $time*$this->velocity;
        $routeLength = $this->getPathLength($this->location, $this->destination);
        $map = array();
        $map[$this->location->getPlaceId()] = 1;
        $map[$this->destination->getPlaceId()] = 1;
        $n = count($this->places);
        while(true)
        {
            $segments = count($this->path) - 1;
            $minDifference = PHP_INT_MAX;
            $placeIndex = -1;
            $segmentIndex = -1;
            for ($j = 0; $j < $segments; $j++)
            {
                $segmentLength = $this->getDistance($this->path[$j], $this->path[$j + 1]);
                for ($k = 0; $k < $n; $k++)
                {
                    if (!isset($map[$this->places[$k]]))
                    {
                        $newSegmentLength = $this->getDistance($this->path[$j], $this->places[$k]) +
                            $this->getDistance($this->places[$k], $this->path[$j + 1]);
                        if(($newSegmentLength - $segmentLength)*($this->places[$k]->getWeight()) < $minDifference)
                        {
                            $minDifference = $newSegmentLength - $segmentLength;
                            $placeIndex = $k;
                            $segmentIndex = $j;
                        }
                    } else {
                        continue;
                    }
                }

                if($routeLength - $this->getPathLength($this->path[$j], $this->path[$j + 1]) +
                    $this->getPathLength($this->path[$j], $this->places[$k]) +
                    $this->getPathLength($this->places[$k], $this->path[$j + 1]) <= $maxRouteLength)
                {
                    array_splice($this->path, $segmentIndex + 1, 0, $this->places[$placeIndex]);
                    $map[$this->places[$placeIndex]->getPlaceId()] = 1;
                }else {
                    for ($k = 0; $k < $n; $k++)
                    {
                        if (!isset($map[$this->places[$k]]))
                        {
                            $newSegmentLength = $this->getDistance($this->path[$j], $this->places[$k]) +
                                $this->getDistance($this->places[$k], $this->path[$j + 1]);
                            if(($newSegmentLength - $segmentLength) < $minDifference)
                            {
                                $minDifference = $newSegmentLength - $segmentLength;
                                $placeIndex = $k;
                                $segmentIndex = $j;
                            }
                        } else {
                            continue;
                        }
                    }
                    if($routeLength - $this->getPathLength($this->path[$j], $this->path[$j + 1]) +
                        $this->getPathLength($this->path[$j], $this->places[$k]) +
                        $this->getPathLength($this->places[$k], $this->path[$j + 1]) <= $maxRouteLength)
                    {
                        array_splice($this->path, $segmentIndex + 1, 0, $this->places[$placeIndex]);
                        $map[$this->places[$placeIndex]->getPlaceId()] = 1;
                    }else{
                        break;
                    }
                }
            }
        }

    }


    private function getDistance(Place& $from, Place& $to)
    {
        return ($from->getX() - $to->getX())*
            ($from->getX() - $to->getX()) +
            ($from->getY() - $to->getY())*
            ($from->getY() - $to->getY());
    }

    private function getDirectPathLength(array& $places)
    {
        $distance = 0;
        $n = count($this->places);
        for($i = 1; $i < $n; $i++)
        {
            $distance += ($places[$i]->getX() - $places[$i - 1]->getX())*
                ($places[$i]->getX() - $places[$i - 1]->getX()) +
                ($places[$i]->getY() - $places[$i - 1]->getY()) *
                ($places[$i]->getY() - $places[$i - 1]->getY());
        }
        return $distance;
    }

    private function getPathLength(Place& $start, Place& $end)
    {
        //todo (some magic using google and some other shit)
        return 0;
    }
}