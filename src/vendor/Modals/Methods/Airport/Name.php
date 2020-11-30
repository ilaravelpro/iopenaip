<?php
namespace iLaravel\iOpenAip\Vendor\Modals\Methods\Airport;

trait Name
{
    public function name() {
        return (string)$this->record->NAME;
    }
}
