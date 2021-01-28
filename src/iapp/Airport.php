<?php

namespace iLaravel\iOpenAip\iApp;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'IOAA';
    public static $s_start = 810000;
    public static $s_end = 24299999;
    protected $table = 'i_airports';
    protected $AirportRunwayModel = 'AirportRunway';
    protected $AirportRadioModel = 'AirportRadio';
    protected $guarded = [];

    protected $casts = [
        'meta' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function (self $event) {
            $event->additionalUpdate();
        });
        static::deleting(function (self $event) {
            $event->radios()->delete();
            $event->runways()->delete();
        });
    }

    public function getTitleAttribute()
    {
        return $this->icao ? strtoupper($this->icao): ucfirst($this->name);
    }

    public function creator()
    {
        return $this->belongsTo(imodal('User'), 'creator_id', 'id');
    }

    public function radios()
    {
        return $this->hasMany(imodal('AirportRadio'));
    }

    public function runways()
    {
        return $this->hasMany(imodal('AirportRunway'));
    }


    public static function findByName($name)
    {
        return static::where('name', $name)->first();
    }

    public static function findByICAO($icao)
    {
        return static::where('icao', $icao)->first();
    }

    public function additionalUpdate($record = null)
    {
        $this->AirportRunwayModel = imodal($this->AirportRunwayModel);
        $this->AirportRadioModel = imodal($this->AirportRadioModel);
        if (!$record) $record = $this;
        $request = \request();
        if (is_array($request->radios) && count($request->radios) == 0) $record->radios()->delete();
        if (is_array($request->runways) && count($request->runways) == 0) $record->runways()->delete();
        if ($request->radios && is_array($request->radios)) {
            $rdelete = $record->radios()->pluck('id')->toArray();
            foreach ($request->radios as $kradio => $radio) {
                if (isset($radio['id'])) {
                    $rdelete = array_diff($rdelete, [$this->AirportRadioModel::id($radio['id'])]);
                    $rradio = $this->AirportRadioModel::findBySerial($radio['id']);
                    unset($radio['id']);
                    unset($radio['id_text']);
                    $rradio->update($radio);
                } else {
                    $radio['airport_id'] = $record->id;
                    $record->radios()->create($radio);
                }
            }
            $this->AirportRadioModel::destroy($rdelete);
            unset($rdelete);
        }
        if ($request->runways && is_array($request->runways)) {
            $rdelete = $record->runways()->pluck('id')->toArray();
            foreach ($request->runways as $krunway => $runway) {
                if (isset($runway['id'])) {
                    $rdelete = array_diff($rdelete, [$this->AirportRunwayModel::id($runway['id'])]);
                    $rrunway = $this->AirportRunwayModel::findBySerial($runway['id']);
                    unset($runway['id']);
                    unset($runway['id_text']);
                    $rrunway->update($runway);
                } else {
                    $runway['airport_id'] = $record->id;
                    $record->runways()->create($runway);
                }
            }
            $this->AirportRunwayModel::destroy($rdelete);
            unset($rdelete);
        }
        return $request;
    }

    public static function findClosest($lon, $lat, $limit = 3)
    {
        return static::selectRaw('*, ST_Distance_Sphere(POINT(latitude,longitude), POINT(?, ?)) as dist',
            [$lat, $lon])
            ->orderBy('dist')
            ->limit($limit)
            ->get();
    }

}
