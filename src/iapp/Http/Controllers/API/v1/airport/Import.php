<?php


namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

trait Import
{
    public function import(Request $request, $country) {
        return ['data' => (new \iLaravel\iOpenAip\Vendor\OpenAip($country, null, 'import'))->_get()];
    }
}
