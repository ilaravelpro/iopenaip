<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 4:52 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;

trait Country
{
    public function country() {
        return (string)$this->record->COUNTRY;
    }
}
