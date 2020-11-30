<?php

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

trait SearchQ
{
    public function searchQ($request, $model, $parent)
    {
        $q = $request->q;
        $id = $this->model::id($q) ? : 'not';
        $model->where(function ($query) use ($q, $id) {
            $query->where('i_airports.id', 'LIKE', "%$id%")
                ->orWhere('i_airports.name', 'LIKE', "%$q%")
                ->orWhere('i_airports.icao', 'LIKE', "%$q%")
                ->orWhere('i_airports.iata', 'LIKE', "%$q%")
                ->orWhere('i_airports.aftn', 'LIKE', "%$q%");
        });
    }
}
