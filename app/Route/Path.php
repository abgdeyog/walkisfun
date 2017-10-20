<?php

namespace App\Route;

class Path
{
    public function from()
    {
         return $this->hasOne('App\Route\Place');
    }

    public function to()
    {
        return $this->hasOne('App\Route\Place');
    }
}