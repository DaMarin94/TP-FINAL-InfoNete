<?php

class Clima{

    public function __construct()
    {}

    public static function getClima(){
        $apiKey = "a22e4febb0c41c9a3b78b372bc39cf6b";
        $cityId = "3433955";

        $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($response);
        $currentTime = time();

        $result['data'] = $data;
        $result['time'] = $currentTime;
        $result['name'] = $data->name;
        $result['date1'] = date("l g:i a", $currentTime);
        $result['date2'] = date("jS F, Y",$currentTime);
        $result['description'] = ucwords($data->weather[0]->description);
        $result['icon'] = $data->weather[0]->icon;
        $result['tempmax'] = $data->main->temp_max;
        $result['tempmin'] = $data->main->temp_min;
        $result['humedad'] = $data->main->humidity;
        $result['speed'] = $data->wind->speed;

        return $result;
    }
}



?>