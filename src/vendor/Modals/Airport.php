<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 8:35 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Modals;

use iLaravel\iOpenAip\Vendor\Modals\Methods\Airport\Country;
use iLaravel\iOpenAip\Vendor\Modals\Methods\Airport\GeoLocation;
use iLaravel\iOpenAip\Vendor\Modals\Methods\Airport\ICAO;
use iLaravel\iOpenAip\Vendor\Modals\Methods\Airport\Import;
use iLaravel\iOpenAip\Vendor\Modals\Methods\Airport\Name;
use iLaravel\iOpenAip\Vendor\Modals\Methods\Airport\Radios;
use iLaravel\iOpenAip\Vendor\Modals\Methods\Airport\Runways;
use Carbon\Carbon;

class Airport extends Modal
{
    protected $excludes = ['import'];
    protected $geoType = 'airport';

    use Name,
        ICAO,
        Country,
        GeoLocation,
        Radios,
        Runways,
        Import;

}
