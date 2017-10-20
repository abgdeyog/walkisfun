<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use GooglePlaces;

class SuggestionController extends CoreApiMethodController
{
    public function serve(Request $request)
    {
        $requiredParams = ['input'];
        $possibleParams = ['offset', 'location', 'radius', 'language', 'types', 'components', 'strictbounds'];
        $defaultPossibleParams = ['location' => '59.9444376,30.2638712', 'radius' => 15000, 'language' => 'ru'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);
        $params = $this->bindFields($possibleParams, $request, $defaultPossibleParams);

        $places = GooglePlaces::placeAutocomplete($requiredFields['input'], $params);

        return $this->successReturn($places);
    }
}
