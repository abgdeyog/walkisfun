<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class CategoriesController extends CoreApiMethodController
{
    public function get(Request $request)
    {
        $requiredParams = [];

        $requiredFields = $this->bindRequiredFields($requiredParams, $request);

        return $this->successReturn(['ok']); // TODO Implement this
    }
}
