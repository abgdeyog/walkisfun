<?php

namespace App\Route;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    private $weight;

    protected $fillable = ['gps_x', 'gps_y', 'place_id'];

    public function Place($placeId = '')
    {
        $this->place_id = $placeId;
        if ($placeId != '') $this->fetchLocation();
    }

    public function fetchLocation()
    {
        $locationResponse = \GooglePlaces::placeDetails($this->getPlaceId())['result']['geometry']['location'];

        $this->setCoordinates($locationResponse['lat'], $locationResponse['lng']);
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function setCoordinates($x, $y)
    {
        $this->gps_x = $x;
        $this->gps_y = $y;
    }

    public function description()
    {
        return $this->hasOne('App\Route\PlaceDescription');
    }

    public function category()
    {
        return $this->belongsTo('App\Route\PlaceCategory');
    }

    public function getX()
    {
        return $this->gps_x;
    }

    public function getY()
    {
        return $this->gps_y;
    }

    public function getPlaceId()
    {
        return $this->place_id;
    }

    public function getWeight()
    {
        return $this->weight;
    }
}