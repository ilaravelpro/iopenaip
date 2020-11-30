<?php

namespace iLaravel\iOpenAip\Vendor\Modals;

use Carbon\Carbon;

class Modal
{
    protected $record = null;
    protected $excludes = [];
    protected $geoType = 'awc';

    public function __construct($record)
    {
        $this->record = $record;
    }

    public function record()
    {
        return $this->record;
    }

    public function geo_type()
    {
        return $this->geoType;
    }

    public function UTCTime($time)
    {
        return (string) $time;
    }

    public function appendExclude($exclude)
    {
        $this->excludes = array_merge($this->excludes, is_array($exclude) ? $exclude : [$exclude]);
        return $this->excludes;
    }

    public function toArray()
    {
        $exclude_functions = array_merge([
            'appendExclude',
            'UTCTime',
            'record',
            'excludes',
            '__construct',
            'toArray',
            'toGeoJson',
        ], $this->excludes);

        $array = [];
        $methods = get_class_methods($this);
        foreach ($methods as $method_name) {
            if (array_search($method_name, $exclude_functions) === false && $this->{$method_name}()) {
                if (is_array($this->{$method_name}())){
                    $array[$method_name] = array_filter((array)($this->{$method_name}()), function ($val){
                        return $val ? true :false;
                    });
                }else
                    $array[$method_name] = $this->$method_name();
            }
        }
        return $array;
    }

    public function toGeoJson()
    {
        $type = 'Point';
        if (method_exists($this, 'area')){
            $type = 'Polygon';
            if (method_exists($this, 'geometry_type'))
                $type = strtoupper($this->geometry_type()) == 'LINE' ? 'LineString' : $type;
            $coordinates = [array_map(function ($val){
                return array_values($val);
            }, $this->area()->toArray())];
        }else
            $coordinates = array($this->longitude(), $this->latitude());
        $feature = array(
            'type' => 'Feature',
            'geometry' => array(
                'type' => $type,
                'coordinates' => $coordinates
            ),
            'properties' => $this->toArray()
        );
        return $feature;
    }

}
