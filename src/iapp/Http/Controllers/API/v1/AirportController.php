<?php

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1;

use iLaravel\Core\iApp\Http\Controllers\API\Controller;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Index;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Data;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Show;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Store;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Update;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Destroy;

class AirportController extends Controller
{
    public $order_list = ['id', 'icao', 'iata', 'aftn'];
    use Index,
        Show,
        Data,
        Store,
        Update,
        Destroy,
        Airport\Import,
        Airport\Except,
        Airport\RequestData,
        Airport\Filters,
        Airport\RequestFilterExtent;

}
