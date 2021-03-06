<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/30/20, 1:56 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;


trait Runways
{
    public function runways()
    {
        $clouds = $this->record->RWY;
        $cloud_array = collect();
        foreach ($clouds as $cloud) {
            foreach (explode('/', (string)$cloud->NAME) as $item) {
                preg_match_all('/^[0-9]*|[RL]/m', $item, $matches, PREG_SET_ORDER, 0);
                $runway = [
                    'name' => (string)$item,
                    'pcn' => (string)$cloud->SFC,
                    'length' => (float)$cloud->LENGTH,
                    'width' => (float)$cloud->WIDTH,
                ];
                $runway['mag_bearing'] = $matches[0][0] * 10;
                if (isset($matches[1]))$runway['dir'] = $matches[1][0];
                unset($runway['category']);
                $cloud_array->push($runway);
                unset($runway);
            }
        }
        return $cloud_array;
    }
}
