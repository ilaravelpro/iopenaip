<?php


namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;
use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

trait Except
{
    public function except(Request $request, $action)
    {
        switch ($action) {
            case 'update':
            case 'store':
                return ['runways', 'radios'];
        }
    }
}
