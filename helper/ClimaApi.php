<?php
require_once 'third-party/openWeather/ClimaApi.php';

class ClimaApi
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

}