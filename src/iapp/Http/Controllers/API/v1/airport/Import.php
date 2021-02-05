<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 9:35 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

trait Import
{
    public function import(Request $request, $country) {
        return ['data' => (new \iLaravel\iOpenAip\Vendor\OpenAip($country, null, 'import'))->_get()];
    }
}
