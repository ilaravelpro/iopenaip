<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/30/20, 1:14 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;

trait GeoLocation
{
    public function latitude()
    {
        return (float)$this->record->GEOLOCATION->LAT;
    }

    public function longitude()
    {
        return (float)$this->record->GEOLOCATION->LON;
    }

    public function elevation()
    {
        return round(((float)$this->record->GEOLOCATION->ELEV)  * 3.2808, 2);
    }
}
