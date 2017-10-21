<?php

namespace App\Route;

class RouteCreator
{
    private $velocity = 5 * 1000 /60;
    private $places = array();
    private $path = array();
    private $location;
    private $destination;
    private $time;

    public function __construct(Place& $location, Place& $destination, &$places, int $time)
    {
        array_push($this->path, $location);
        array_push($this->path, $destination);
        $this->location = $location;
        $this->destination = $destination;
        $this->places = &$places;
        $this->time = $time;
    }

    public function addPlace(Place& $place)
    {
        array_push($this->places, $place);
    }
    //int time in minutes
    private function createRoute(int $time)
    {
        $maxRouteLength = $time * ($this->velocity);
        $routeLength = $this->getPathLength($this->location, $this->destination);
        $map = array();
        $map[$this->location->getPlaceId()] = 1;
        $map[$this->destination->getPlaceId()] = 1;
        $n = count($this->places);
        for($i = 0; $i < 21; $i++)
        {
            $segments = count($this->path) - 1;
            $minDifference = PHP_INT_MAX;
            $placeIndex = -1;
            $segmentIndex = -1;
            //var_dump($segments);
           // if ($i == 2) var_dump($this->path);
            //if($i == 1) exit;
            $segmentLength = 0;
            for ($j = 0; $j < $segments; $j++)
            {
                $segmentLength = $this->getDistance($this->path[$j], $this->path[$j + 1]);
                for ($k = 0; $k < $n; $k++)
                {
                    //var_dump($this->places[$k]);
                    //exit;
                    //array_key_exists($map, $this->places[$k]->getId())
                    if (!isset($map[$this->places[$k]->getPlaceId()]))
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
            }
            if(($placeIndex != -1) && $routeLength - $this->getPathLength($this->path[$segmentIndex], $this->path[$segmentIndex + 1]) +
                $this->getPathLength($this->path[$segmentIndex], $this->places[$placeIndex]) +
                $this->getPathLength($this->places[$placeIndex], $this->path[$segmentIndex + 1]) <= $maxRouteLength)
            {
                //var_dump($this->path);
                //var_dump($this->places[$placeIndex]);
                $routeLength +=
                    $this->getPathLength($this->path[$segmentIndex], $this->places[$placeIndex]) +
                    $this->getPathLength($this->places[$placeIndex], $this->path[$segmentIndex + 1]) -
                    $this->getPathLength($this->path[$segmentIndex], $this->path[$segmentIndex + 1]);
                array_splice($this->path, $segmentIndex + 1, 0, [$this->places[$placeIndex]]);
                //$this->path[] = $this->places[$placeIndex];
                $map[$this->places[$placeIndex]->getPlaceId()] = 1;
            }else {

                for ($j = 0; $j < $segments; $j++)
                {
                    for ($k = 0; $k < $n; $k++)
                    {
                        if (!isset($map[$this->places[$k]->getPlaceId()]))
                        {
                         //   echo "work";
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
                }
                if(($placeIndex != -1) && $routeLength - $this->getPathLength($this->path[$segmentIndex], $this->path[$segmentIndex + 1]) +
                    $this->getPathLength($this->path[$segmentIndex], $this->places[$placeIndex]) +
                    $this->getPathLength($this->places[$placeIndex], $this->path[$segmentIndex + 1]) <= $maxRouteLength)
                {
                    $routeLength +=
                        $this->getPathLength($this->path[$segmentIndex], $this->places[$placeIndex]) +
                        $this->getPathLength($this->places[$placeIndex], $this->path[$segmentIndex + 1]) -
                        $this->getPathLength($this->path[$segmentIndex], $this->path[$segmentIndex + 1]);
                    array_splice($this->path, $segmentIndex + 1, 0, [$this->places[$placeIndex]]);
                    //array_splice($this->path, $segmentIndex + 1, 0, $this->places[$placeIndex]);
                    $map[$this->places[$placeIndex]->getPlaceId()] = 1;
                }else{
                    break;
                }
            }
        }
    }

    public function getRoute()
    {
        $this->createRoute($this->time);
        return $this->path;
    }

    private function getDistance(Place& $from, Place& $to)
    {
        return $this->getGpsDistance($from->getX(), $from->getY(), $to->getX(), $to->getY());
    }
    private function getGpsDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
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

    private function getPathLength(Place& $from, Place& $to)
    {
        //google magic
        return $this->getGpsDistance($from->getX(), $from->getY(), $to->getX(), $to->getY());
    }
}