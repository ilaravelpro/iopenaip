<?php
namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;

trait ICAO
{
    public function icao() {
        return (string)$this->record->ICAO;
    }
}
