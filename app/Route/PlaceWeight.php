<?php

namespace App\Route;

use Illuminate\Database\Eloquent\Model;

class PlaceWeight extends Model
{
    public $fillable = ['placeID', 'publicID', 'weight'];

    public $placeID;
    public $publicID;
    public $weight;

    public function __construct($placeID, $publicID, $weight = 0)
    {
        $this->publicID = $publicID;
        $this->placeID = $placeID;
        $this->weight = $weight;
    }
}