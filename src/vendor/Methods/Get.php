<?php


namespace iLaravel\iOpenAip\Vendor\Methods;


trait Get
{
    public static function get($country = null, $section = null, $action = null)
    {
        return (new self($country, $section, $action))->_get();
    }

    public function _get()
    {
        if ($this->data) return $this->exportData($this->data);
        $xml_data = $this->request();
        if (!$xml_data) return [];
        $xml = new \SimpleXMLElement($xml_data);
        $this->data = $this->modal($xml, false, true);
        return $this->data;
    }
}
