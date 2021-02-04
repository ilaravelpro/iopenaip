<?php

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

trait Filters
{
    public function filters($request, $model, $parent = null, $operators = [])
    {
        $filters = [
            [
                'name' => 'all',
                'title' => _t('all'),
                'type' => 'text',
            ],
            [
                'name' => 'icao',
                'title' => _t('icao'),
                'type' => 'text'
            ],
            [
                'name' => 'iata',
                'title' => _t('iata'),
                'type' => 'text'
            ],
            [
                'name' => 'aftn',
                'title' => _t('aftn'),
                'type' => 'text'
            ],
        ];
        return [$filters, [], $operators];
    }
}
