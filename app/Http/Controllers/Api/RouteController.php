<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class RouteController extends CoreApiMethodController
{
    public function build(Request $request)
    {
        $requiredParams = ['from', 'to', 'time', 'categories'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        return $this->successReturn(['ok']);  // TODO Implement this
    }

    public function estimateTime(Request $request)
    {
        $requiredParams = ['from', 'to'];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        return $this->successReturn(['ok']);  // TODO Implement this
    }
}
