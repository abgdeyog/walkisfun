<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Exceptions\WrongParamsException;
use Illuminate\Http\Request;

class CoreApiMethodController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bindRequiredFields($requiredFields, Request $request)
    {
        $fields = [];
        foreach ($requiredFields as $fieldName) {
            if (!isset($request->$fieldName))
                throw new WrongParamsException();
            $fields[$fieldName] = explode(",", $request->get($fieldName));
            if (count($fields[$fieldName]) == 1) $fields[$fieldName] = $fields[$fieldName][0];
        }
        return $fields;
    }

    public
    function bindFields($possibleFields, Request $request, $defaultValues = [])
    {
        $fields = [];
        foreach ($possibleFields as $fieldName) {
            if (isset($request->$fieldName)) {
                $fields[$fieldName] = explode(",", $request->get($fieldName));
                if (count($fields[$fieldName]) == 1) $fields[$fieldName] = $fields[$fieldName][0];
            } elseif (isset($defaultValues[$fieldName])) {
                $fields[$fieldName] = $defaultValues[$fieldName];
            }
        }
        return $fields;
    }

    public function successReturn($response)
    {
        $responseData = ['response' => $response];
        return response()->json($responseData);
    }
}
