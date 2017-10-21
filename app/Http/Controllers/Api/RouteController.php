<?php

namespace App\Http\Controllers\Api;

use App\Route\RouteProcessor;
use Illuminate\Http\Request;

class RouteController extends CoreApiMethodController
{
    public function build(Request $request)
    {
        $requiredParams = ['from', 'to', 'time', 'categories'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        $route = new RouteProcessor($requiredFields['from'], $requiredFields['to'], $requiredFields['categories'], $requiredFields['time']);

        return $this->successReturn($route->buildRoute());
    }

    public function estimateTime(Request $request)
    {
        $requiredParams = ['from', 'to'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        return $this->successReturn(['ok']);  // TODO Implement this
    }
}
