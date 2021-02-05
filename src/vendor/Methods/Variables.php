<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 9:25 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\Vendor\Methods;

trait Variables
{
    private $service_url = "https://www.openaip.net/customer_export_akfshb9237tgwiuvb4tgiwbf/";

    public $data = [];
    protected $country = 'ir';
    protected $section = 'wpt';
    protected $action = null;

    public $modals = [
        "asp" => "airspace",
        "hot" => "hotspot",
        "nav" => "navigation",
        "wpt" => "\iLaravel\iOpenAip\Vendor\Modals\Airport",
    ];

    public $sections = [
        "asp" => "airspace",
        "hot" => "hotspot",
        "nav" => "navigation",
        "wpt" => "airport",
    ];

    public $sources = [
        "asp" => "AIRSPACES",
        "hot" => "HOTSPOTS",
        "nav" => "NAVAIDS",
        "wpt" => "WAYPOINTS",
    ];

    public $sourcesSub = [
        "asp" => "ASP",
        "hot" => "HOTSPOT",
        "nav" => "NAVAID",
        "wpt" => "AIRPORT",
    ];
}
