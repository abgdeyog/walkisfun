<?php

namespace App\Route;

use Illuminate\Database\Eloquent\Model;

class PlaceCategory extends Model
{
    protected $fillable = ['title', 'description'];

    public function places()
    {
        return $this->hasMany('App\Route\Place');
    }
}