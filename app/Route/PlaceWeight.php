<?php

namespace App\Route;

use Illuminate\Database\Eloquent\Model;

class PlaceWeight extends Model
{
    public $fillable = ['place_id', 'public_id', 'weight'];
}