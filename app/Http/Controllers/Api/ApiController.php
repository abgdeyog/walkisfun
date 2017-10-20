<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Exceptions\UnknownMethodException;
use Illuminate\Http\Request;

class ApiController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function serve($method, Request $request)
    {
        switch ($method) {
            case 'places.suggest':
                $controller = new SuggestionController();
                return $controller->serve($request);
            default:
                throw new UnknownMethodException();
        }
    }
}
