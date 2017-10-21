<?php

namespace App\Route;

use App;

class PlaceWeightWorker
{

    public static function like($placeID, $subs)
    {
        foreach ($subs as $sub) {
            $placeWeight = PlaceWeight::all()->where('public_id', '=', $sub)->first();

            if ($placeWeight == null) {
                PlaceWeight::create(['place_id' => $placeID, 'public_id' => $sub, 'weight' => self::getLikeWeight()]);
            } else {
                $placeWeight->weight += self::getLikeWeight();
                $placeWeight->save();
            }
        }
    }

    public static function dislike($placeID, $subs)
    {
        foreach ($subs as $sub) {
            $placeWeight = PlaceWeight::all()->where('public_id', '=', $sub)->first();

            if ($placeWeight == null) {
                PlaceWeight::create(['place_id' => $placeID, 'public_id' => $sub, 'weight' => -self::getLikeWeight()]);
            } else {
                $placeWeight->weight -= self::getLikeWeight();
                $placeWeight->save();
            }
        }
    }

    protected static function getLikeWeight()
    {
        return 2000000000 / log(self::getUserNumber()) / 100;
    }

    protected static function getUserNumber()
    {
        return App\User::count() < 1000 ? 1000 : App\User::count();
    }
}