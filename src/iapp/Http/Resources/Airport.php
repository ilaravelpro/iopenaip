<?php

namespace iLaravel\iOpenAip\iApp\Http\Resources;

use iLaravel\Core\iApp\Http\Resources\Resource;

class Airport extends Resource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        if ($this->radios)
            $data['radios'] = Airport\AirportChild::collection($this->radios);
        if ($this->runways)
            $data['runways'] = Airport\AirportChild::collection($this->runways);
        unset($data['creator_id']);
        return $data;
    }

    public function toGeoJson($request)
    {
        $feature = array(
            'type' => 'Feature',
            'geometry' => array(
                'type' => 'Point',
                'coordinates' => [(float)$this->longitude, (float)$this->latitude]
            ),
            'properties' => array_merge(['geo_type' => 'flight_airports'], $this->toArray($request))
        );
        return $feature;
    }
}
