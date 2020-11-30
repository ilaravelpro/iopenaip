<?php


namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

trait RequestFilterExtent
{
    public function requestFilterExtent($request, $model, $parent)
    {
        if ($request->minLon || $request->minLat || $request->maxLon || $request->maxLat) {
            $model->where( function ($query) use ($request) {
                if ($request->minLon)
                    $query->where('longitude', '>', $request->minLon);
                if ($request->maxLon)
                    $query->where('longitude', '<', $request->maxLon);
                if ($request->minLat)
                    $query->where('latitude', '>', $request->minLat);
                if ($request->maxLat)
                    $query->where('latitude', '<', $request->maxLat);
            });
        }
    }
}
