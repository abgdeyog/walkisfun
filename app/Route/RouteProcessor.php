<?php

namespace App\Route;

use App\VKWorker;

class RouteProcessor
{
    private $startPointId;
    private $endPointId;
    private $cats;
    private $routeTime;
    private $vkWorker;
    private $subscriptions;

    public function __construct($startPointId, $endPointId, $cats, $routeTime)
    {
        $this->startPointId = $startPointId;
        $this->endPointId = $endPointId;
        $this->cats = $cats;
        $this->routeTime = $routeTime;
    }

    protected function setVkWorker()
    {
        $this->vkWorker = new VKWorker(\Auth::user()->token);
    }

    protected function setSubscriptions()
    {
        $this->subscriptions = $this->vkWorker->usersGetSubscriptions();
    }

    public function buildRoute()
    {
        $this->setVkWorker();
        $this->setSubscriptions();

        $places = $this->getPlacesWithWeights();

        $placesArray = [];
        foreach ($places as $place) {
            $placesArray[] = $place;
        }

        $startPlace = Place::all()->where('place_id', '=', $this->startPointId)->first();
        if ($startPlace == null) {
            $startPlace = new Place();
            $startPlace->place_id = $this->startPointId;
            $startPlace->fetchLocation();
        }

        $endPlace = Place::all()->where('place_id', '=', $this->endPointId)->first();
        if ($endPlace == null) {
            $endPlace = new Place();
            $endPlace->place_id = $this->endPointId;
            $endPlace->fetchLocation();
        }

        $route = new RouteCreator($startPlace, $endPlace, $placesArray, $this->routeTime);
        $route = $route->getRoute();

        //var_dump($this->rebuildRoute($route));

        $response = $this->rebuildRoute($route);

        foreach ($response['places'] as &$place) {
            try {
                $placeDescription = PlaceDescription::all()->where('place_id', '=', $place['place_description_id'])->first();
                $place['title'] = $placeDescription->title;
                $place['description'] = $placeDescription->description;
            } catch (\Exception $e) {
                unset($place);
            }
        }

        return $response;
    }

    protected function rebuildRoute(array $route)
    {
        $waypoints = [];
        $from = $route[0];
        $n = count($route) - 1;
        $to = $route[$n];

        $places = [];
        for ($i = 1; $i < $n; $i++) {
            $waypoints[] = 'place_id:' . $route[$i]->getPlaceId();
            $places[] = ['id' => $route[$i]->id, 'gps_x' => $route[$i]->gps_x, 'gps_y' => $route[$i]->gps_y, 'place_description_id' => $route[$i]->place_description_id];
        }

        return ['route' => ['from' => $from, 'to' => $to, 'waypoints' => $waypoints], 'places' => $places];
    }

    protected function getPlacesWithWeights()
    {
        $places = Place::all()->whereIn('place_category_id', $this->cats);
        $places = $this->calculateWeights($places);

        return $places;
    }

    protected function calculateWeights(&$places)
    {
        foreach ($places as &$place) {
            $place->setWeight($this->weightToFloat($this->calculateWeightForPlace($place)));
        }

        return $places;
    }

    protected function weightToFloat($placeWeight)
    {
        return $placeWeight / 2000000000 + 1;
    }

    protected function calculateWeightForPlace(Place &$place)
    {
        return PlaceWeight::all()->where('place_id', '=', $place->id)->whereIn('public_id', $this->subscriptions)->sum('weight');
    }
}