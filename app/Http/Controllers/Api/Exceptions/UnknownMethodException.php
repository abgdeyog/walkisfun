<?php

namespace App\Http\Controllers\Api\Exceptions;

use Exception;

class UnknownMethodException extends Exception
{

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json(
            ['error' => 'Unknown method.']
        );
    }
}