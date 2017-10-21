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

        $startPlace = Place::all()->where('place_id', '=', $this->startPointId)->first() ?? new Place($this->startPointId);
        $endPlace = Place::all()->where('place_id', '=', $this->endPointId)->first() ?? new Place($this->endPointId);

        $route = new RouteCreator($startPlace, $endPlace, $placesArray, $this->routeTime);
        return $route->getRoute();
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
        return $placeWeight / PHP_INT_MAX + 1;
    }

    protected function calculateWeightForPlace(Place &$place)
    {
        return PlaceWeight::all()->where('place_id', '=', $place->id)->whereIn('public_id', $this->subscriptions)->sum('weight');
    }
}