<?php

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
