<?php


namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;


trait Runways
{
    public function runways()
    {
        $clouds = $this->record->RWY;
        $cloud_array = collect();
        foreach ($clouds as $cloud) {
            foreach (explode('/', (string)$cloud->NAME) as $item) {
                preg_match_all('/^[0-9]*|[RL]/m', $item, $matches, PREG_SET_ORDER, 0);
                $runway = [
                    'name' => (string)$item,
                    'pcn' => (string)$cloud->SFC,
                    'length' => (float)$cloud->LENGTH,
                    'width' => (float)$cloud->WIDTH,
                ];
                $runway['dir'] = $matches[0][0] * 10;
                if (isset($matches[1]))$runway['side'] = $matches[1][0] == 'R' ? 'right' : 'left';
                unset($runway['category']);
                $cloud_array->push($runway);
                unset($runway);
            }
        }
        return $cloud_array;
    }
}
