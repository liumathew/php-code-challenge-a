<?php

namespace Services;

use Connection\Connection;
use Lxr\GeoLocation;

class IPApiService
{
    public function getGeoLocation($ip){
        $connection = new Connection();
        $response = $connection->curlRequest("http://ip-api.com/json/$ip");

        $city    = $response->city;
        $country = $response->country;
        $region  = $response->region;
        $lat     = $response->lat;
        $lon     = $response->lon;

        $geoLocation = new GeoLocation();
        $geoLocation->setCity($city)
                    ->setCountry($country)
                    ->setRegion($region)
                    ->setLatitude($lat)
                    ->setLongitude($lon);


        return $geoLocation;
    }
}