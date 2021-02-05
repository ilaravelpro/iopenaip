<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/29/20, 6:32 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\iApp\Http\Resources\Airport;
use iLaravel\Core\iApp\Http\Resources\Resource;

class AirportChild extends Resource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        unset($data['airport_id']);
        unset($data['actions']);
        return $data;
    }
}
