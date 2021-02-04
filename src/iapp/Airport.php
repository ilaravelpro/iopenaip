<?php

namespace iLaravel\iOpenAip\iApp;

use iLaravel\Core\iApp\Http\Requests\iLaravel as Request;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use \iLaravel\Core\iApp\Modals\Modal;

    public static $s_prefix = 'IOAA';
    public static $s_start = 810000;
    public static $s_end = 24299999;
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
            $policy = ipolicy('AirportPolicy');
            if ((new $policy())->update(auth()->user(), $event) || (new $policy())->create(auth()->user(), $event) ){
                $event->additionalUpdate();
            }
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
        $request = new Request($this->getAdditional());
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

    public function rules($request, $action, $arg = null) {
        if ($arg) $arg = is_string($arg) ? $this::findBySerial($arg) : $arg;
        $rules = [];
        $additionalRules = [
            'radios.*.category' => "nullable|string|max:191",
            'radios.*.frequency' => "nullable|regex:/^[0-9]{1,5}(\.\d{0,3})?$/",
            'radios.*.type' => "nullable|string|max:191",
            'radios.*.spec' => "nullable|string|max:191",
            'radios.*.description' => "nullable|max:191|regex:/^[a-zA-Z0-9]+(([',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/",
            'runways.*.name' => "nullable|max:191|regex:/^[a-zA-Z0-9]+(([',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/",
            'runways.*.dir' => "nullable|numeric|min:-360|max:360",
            'runways.*.side' => "nullable|in:left,right",
            'runways.*.pcn' => "nullable|max:191|regex:/^[a-zA-Z0-9]+(([',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/",
            'runways.*.length' => "nullable|regex:/^[0-9]{1,6}(\.\d{0,6})?$/",
            'runways.*.width' => "nullable|regex:/^[0-9]{1,5}(\.\d{0,6})?$/",
        ];
        switch ($action) {
            case 'store':
                $rules = ["creator_id" => "required|exists:users,id"];
            case 'update':
                $rules = array_merge($rules, [
                    'name' => "required|max:191|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/",
                    'icao' => "nullable|min:4|max:4",
                    'iata' => "nullable|max:3",
                    'aftn' => "nullable|max:191|regex:/^[a-zA-Z0-9]+(([',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/",
                    'elevation' => "nullable|numeric|min:0|max:99999",
                    'longitude' => "nullable|longitude",
                    'latitude' => "nullable|latitude",
                    'country' => "nullable|country",
                    "status" => "nullable|in:" . join(iconfig('status.airports', iconfig('status.global')), ','),
                ], $additionalRules);
                if ($arg == null || (isset($arg->icao) && $arg->icao != $request->icao)) $rules['icao'] .= '|unique:airports,icao';
                if ($arg == null || (isset($arg->iata) && $arg->iata != $request->iata)) $rules['iata'] .= '|unique:airports,iata';
                break;
            case 'additional':
                $rules = $additionalRules;
                break;
        }
        return $rules;
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
