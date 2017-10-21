<?php

namespace App\Route;

class PlaceWeightWorker
{
    const WEIGHT_TO_ADD = 1;

    public static function like($placeID, $subs)
    {
        foreach ($subs as $sub) {
            $placeWeight = PlaceWeight::all()->where('public_id', '=', $sub)->first();

            if ($placeWeight == null) {
                $placeWeight = new PlaceWeight($placeID, $sub);
            }

            $placeWeight->weight += PlaceWeightWorker::WEIGHT_TO_ADD;
            $placeWeight->save();
        }
    }

    public static function dislike($placeID, $subs)
    {
        foreach ($subs as $sub) {
            $placeWeight = PlaceWeight::all()->where('public_id', '=', $sub)->first();

            if ($placeWeight == null) {
                $placeWeight = new PlaceWeight($placeID, $sub);
            }

            $placeWeight->weight -= PlaceWeightWorker::WEIGHT_TO_ADD;
            $placeWeight->save();
        }
    }
}