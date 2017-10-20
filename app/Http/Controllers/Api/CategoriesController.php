<?php

namespace App\Http\Controllers\Api;

use App\Route\PlaceCategory;
use Illuminate\Http\Request;

class CategoriesController extends CoreApiMethodController
{
    public function get(Request $request)
    {
        $categories = PlaceCategory::all();

        return $this->successReturn([$categories]);
    }
}
