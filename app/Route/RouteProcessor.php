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
        $this->vkWorker = new VKWorker(Auth::user()->token);
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

        $startPlace = Place::all()->where('place_id', '=', $this->startPointId)->first() ?? new Place($this->startPointId);
        $endPlace = Place::all()->where('place_id', '=', $this->endPointId)->first() ?? new Place($this->endPointId);

        $route = new RouteCreator($startPlace, $endPlace, $places, $this->routeTime);
        return $route->buildRoute();
    }

    protected function getPlacesWithWeights()
    {
        $places = Place::all()->whereIn('category', $this->cats);
        $places = $this->calculateWeights($places);

        return $places;
    }

    protected function calculateWeights(&$places): array
    {
        foreach ($places as &$place) {
            $place->setWeight($this->calculateWeightForPlace($place));
        }

        return $places;
    }

    protected function calculateWeightForPlace(Place &$place): Place
    {
        return PlaceWeight::all()->where('place_id', '=', $place->id)->whereIn('public_id', $this->subscriptions)->sum('weight');
    }
}