<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 9:30 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Methods;


trait Construct
{
    public function __construct($country = 'ir', $section = 'wpt', $action = null)
    {
        $this->country = $country ? : 'ir';
        $this->section = $section ? : 'wpt';
        $this->action = $action;
    }
}
