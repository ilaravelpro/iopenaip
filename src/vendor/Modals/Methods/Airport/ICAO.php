<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 4:52 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;

trait ICAO
{
    public function icao() {
        return (string)$this->record->ICAO;
    }
}
