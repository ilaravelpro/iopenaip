<?php


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
