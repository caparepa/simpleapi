<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 1/24/2018
 * Time: 10:17 PM
 */

trait RestTrait
{
    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api/v'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/api/v') !== false;
    }
}