<?php

namespace App\Route;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    private $placeId;
    private $weight;

    protected $fillable = ['gpsX', 'gpsY', 'placeId'];

    public function Place($placeId = '')
    {
        $this->placeId = $placeId;
        if ($placeId != '') $this->fetchLocation();//todo
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