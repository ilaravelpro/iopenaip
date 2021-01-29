<?php

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

use App\Point;

trait
Rules
{
    public function rules(Request $request, $action, $arg = null, $unique = null)
    {
        $rules = [];
        if ($arg) $arg = $this->model::findBySerial($arg);
        switch ($action) {
            case 'store':
            case 'update':
                $rules = [
                    'creator_id' => "nullable",
                    'logo' => 'nullable|mimes:jpeg,jpg,png,gif|max:5120|dimensions:ratio=1',
                    'name' => "required|max:191|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",
                    'icao' => "nullable|max:191|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",
                    'iata' => "nullable|max:191|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",
                    'aftn' => "nullable|max:191|regex:/^[a-zA-Z0-9]+(([',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/",
                    'elevation' => "nullable|max:191",
                    'longitude' => "nullable",
                    'latitude' => "nullable",
                    'country' => "nullable",
                ];
                if ($arg == null || (isset($arg->icao) && $arg->icao != $request->icao)) $rules['icao'] .= '|unique:airports,icao';
                if ($arg == null || (isset($arg->iata) && $arg->iata != $request->iata)) $rules['iata'] .= '|unique:airports,iata';
                break;
        }
        $unique = $request->has('unique') ? $request->unique : $unique;
        if ($unique) return str_replace(['required'], ['nullable'], _get_value($rules, $unique, 'nullable|string'));
        return $rules;
    }
}
