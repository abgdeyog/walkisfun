<?php

namespace App\Http\Controllers\Api;

use App\Route\Place;
use App\Route\PlaceDescription;
use App\Route\PlaceWeightWorker;
use App\VKWorker;
use Illuminate\Http\Request;

class PlaceController extends CoreApiMethodController
{
    public function getTitle(Request $request)
    {
        $requiredParams = ['id'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        $placeDescriptionId = Place::all()->where('id', '=', $requiredFields['id'])->first()->place_description_id;

        $placeTitle = PlaceDescription::all()->where('place_id', '=', $placeDescriptionId)->first()->title;

        return $this->successReturn($placeTitle);
    }

    public function like(Request $request)
    {
        $requiredParams = ['placeID'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        $vkWorker = new VKWorker(\Auth::user()->token);
        $subs = $vkWorker->usersGetSubscriptions();

        PlaceWeightWorker::like($requiredFields['placeID'], $subs);

        return $this->successReturn(['ok']);
    }

    public function dislike(Request $request)
    {
        $requiredParams = ['placeID'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        $vkWorker = new VKWorker(\Auth::user()->token);
        $subs = $vkWorker->usersGetSubscriptions();

        PlaceWeightWorker::dislike($requiredFields['placeID'], $subs);

        return $this->successReturn(['ok']);
    }
}
