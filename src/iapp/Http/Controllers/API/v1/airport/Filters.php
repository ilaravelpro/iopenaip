<?php

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

trait Filters
{
    public function filters($request, $model, $parent = null, $operators = [])
    {
        $filters = [];
        $current = [];
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
        $this->requestFilter($request, $model, $parent, $filters, $operators);
        if ($request->q) {
            $this->searchQ($request, $model, $parent);
            $current['q'] = $request->q;
        }
        $this->requestFilterExtent($request, $model, $parent);
        return [$filters, $current, $operators];
    }
}
