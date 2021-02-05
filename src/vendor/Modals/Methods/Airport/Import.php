<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/30/20, 1:49 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;

trait Import
{
    public function import()
    {
        $Airport = imodal('Airport');
        $item = $Airport::where('name', $this->name())->first() ?: new $Airport();
        $item->name = $this->name();
        $item->icao = $this->icao();
        $item->country = $this->country();
        $item->longitude = $this->longitude();
        $item->latitude = $this->latitude();
        $item->elevation = $this->elevation();
        $item->save();
        if ($item->radios->count())
            foreach ($this->radios() as $index => $radio)
                if (isset($radio['name']) && $model = $item->radios()->where('name', $radio['name'])->first())
                    $model->update($radio);
                else
                    $item->radios()->create($radio);
        else
            $item->radios()->createMany($this->radios()->toArray());
        if ($item->runways->count())
            foreach ($this->runways() as $index => $runway){
                if (isset($runway['name']) && $model = $item->runways()->where('name', $runway['name'])->first())
                    $model->update($runway);
                else
                    $item->runways()->create($runway);
            }
        else
            $item->runways()->createMany($this->runways()->toArray());
    }
}
