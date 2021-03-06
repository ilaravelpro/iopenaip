<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/2/21, 7:24 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

trait RequestFilterExtent
{
    public function requestFilterExtent($request, $model, $parent)
    {
        $request->validate([
            'minLat' => 'nullable|latitude',
            'maxLat' => 'nullable|latitude',
            'minLon' => 'nullable|longitude',
            'maxLon' => 'nullable|longitude',
        ]);
        if ($request->minLon || $request->minLat || $request->maxLon || $request->maxLat) {
            $model->where( function ($query) use ($request) {
                $start = (object) [
                    'latitude' => round($request->minLat, 2),
                    'longitude' => round($request->minLon, 2),
                ];
                $end = (object) [
                    'latitude' => round($request->maxLat, 2),
                    'longitude' => round($request->maxLon, 2),
                ];
                $query->whereRaw("(CASE WHEN $start->latitude < $end->latitude THEN latitude BETWEEN $start->latitude AND $end->latitude ELSE latitude BETWEEN $end->latitude AND $start->latitude END) AND (CASE WHEN $start->longitude < $end->longitude THEN longitude BETWEEN $start->longitude AND $end->longitude ELSE longitude BETWEEN $end->longitude AND $start->longitude END)");
            });
        }
    }
}
