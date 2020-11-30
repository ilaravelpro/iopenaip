<?php


namespace iLaravel\iOpenAip\Vendor\Methods;


trait Modal
{
    private function modal($response, $single = false, $toArray = false)
    {
        $modal = $this->modals[$this->section];
        $clouds = $response->{$this->sources[$this->section]}->{$this->sourcesSub[$this->section]};
        $cloud_array = collect();
        foreach ($clouds as $cloud) {
            $item  = new $modal($cloud);
            $cloud_array->push($item->toArray());
            if (method_exists($item, 'import') && $this->action == 'import')
                $item->import();
        }
        if ($single)
            return $single;
        return $cloud_array;
    }
}
