<?php


namespace iLaravel\iOpenAip\Vendor\Methods;


use GuzzleHttp\Client;

trait Request
{
    private function request()
    {
        try {
            $client = new Client(['verify' => false]);
            $result = $client->get("{$this->service_url}{$this->country}_{$this->section}.aip", []);
            $content = $result->getBody()->getContents();
            $statuscode = $result->getStatusCode();
            if (200 !== $statuscode)
                throw new \Exception("Unable to retrieve weather data, http code " . $statuscode);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $content;
    }
}
