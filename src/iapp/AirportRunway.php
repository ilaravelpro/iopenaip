<?php

namespace iLaravel\iOpenAip\iApp;

use Illuminate\Database\Eloquent\Model;

class AirportRunway extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'IOAARU';
    public static $s_start = 810000;
    public static $s_end = 24299999;
    protected $table = 'i_airport_runways';

    protected $guarded = [];

    public function airport()
    {
        return $this->belongsTo(imodal('Airport'));
    }
}
