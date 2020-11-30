<?php

namespace iLaravel\iOpenAip\iApp;

use Illuminate\Database\Eloquent\Model;

class AirportRadio extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'IOAAR';
    public static $s_start = 810000;
    public static $s_end = 24299999;
    protected $table = 'i_airport_radios';

    protected $guarded = [];

    public function airport()
    {
        return $this->belongsTo(imodal('Airport'));
    }
}
