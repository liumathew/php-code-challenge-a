<?php

namespace Services;
use Connection\Connection;
use Lxr\Weather;


class OpenWeatherMap
{
    public function getWeather($lat,$lon){
        $connection = new Connection();
        $response = $connection->curlRequest(
            "http://api.openweathermap.org/data/2.5/weather?appid=6103b0f582e78c7382bc6b0cdc06deb8&units=metric&lat=$lat&lon=$lon");

        $currentTemp = $response->main->temp;
        $lowTemp     = $response->main->temp_min;
        $highTemp    = $response->main->temp_max;

        $speedWind     = $response->wind->speed;
        $directionWind = $response->wind->deg;

        $city = $response->name;

        $temperature = new Weather\Temperature();
        $wind        = new Weather\Wind();

        $temperature->setCurrent($currentTemp)
                    ->setHigh($highTemp)
                    ->setLow($lowTemp);

        $wind->setSpeed($speedWind)
             ->setDirection($directionWind);

        $weather = new Weather();
        $weather->setCity($city)
                ->setTemperature($temperature)
                ->setWind($wind);

        return $weather;
    }
} 