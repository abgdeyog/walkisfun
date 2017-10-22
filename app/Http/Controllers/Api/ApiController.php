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
            case 'route.build':
                $controller = new RouteController();
                return $controller->build($request);
            case 'route.estimateTime':
                $controller = new RouteController();
                return $controller->estimateTime($request);
            case 'categories.get':
                $controller = new CategoriesController();
                return $controller->get($request);
            case 'place.like':
                $controller = new PlaceController();
                return $controller->like($request);
            case 'place.dislike':
                $controller = new PlaceController();
                return $controller->dislike($request);
            case 'place.getTitle':
                $controller = new PlaceController();
                return $controller->getTitle($request);
            default:
                throw new UnknownMethodException();
        }
    }
}
