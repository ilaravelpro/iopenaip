<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/2/21, 6:40 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iOpenAip\iApp;

use Illuminate\Database\Eloquent\Model;

class AirportRunway extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'IOAARU';
    public static $s_start = 810000;
    public static $s_end = 24299999;

    protected $guarded = [];

    public function airport()
    {
        return $this->belongsTo(imodal('Airport'));
    }
}
