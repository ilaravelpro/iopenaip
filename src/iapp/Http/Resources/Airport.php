<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 8:25 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

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
            'properties' => [
                'id' => $this->serial,
                'title' => $this->name ? $this->name . ($this->icao ? " ($this->icao)" : "") : $this->title,
                'name' => $this->name,
                'icao' => $this->icao,
                'iata' => $this->iata,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'geo_type' => 'flight_airports'
            ]
        );
        return $feature;
    }
}
