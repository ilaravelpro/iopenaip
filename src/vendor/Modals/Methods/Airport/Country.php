<?php
namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;

trait Country
{
    public function country() {
        return (string)$this->record->COUNTRY;
    }
}
