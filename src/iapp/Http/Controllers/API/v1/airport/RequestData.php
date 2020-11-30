<?php

namespace iLaravel\iOpenAip\iApp\Http\Controllers\API\v1\Airport;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;

use App\Point;

trait RequestData
{
    public function requestData(Request $request, $action, &$data)
    {
        if (in_array($action, ['store']))
            $data['creator_id'] = auth()->id();
    }
}
