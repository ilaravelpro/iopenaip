<?php


namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;


trait Radios
{
    public function radios()
    {
        $clouds = $this->record->RADIO;
        $cloud_array = collect();
        foreach ($clouds as $cloud) {
            $cloud_array->push(
                [
                    'category' => (string)$cloud->attributes()->CATEGORY,
                    'type' => (string)$cloud->TYPE,
                    'spec' => (string)$cloud->DESCRIPTION,
                    'frequency' => (float)$cloud->FREQUENCY,
                ]);
        }
        return $cloud_array;
    }
}
