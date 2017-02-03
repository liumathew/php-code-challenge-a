<?php

namespace Services;


use Connection\Connection;
use Lxr\GeoLocation;

class FreeGeoIP {

    public function getGeoLocation($ip){
        $connection = new Connection();
        $response = $connection->curlRequest("http://freegeoip.net/json/$ip");

        $city    = $response->city;
        $country = $response->country_name;
        $region  = $response->region_code;
        $lon     = $response->longitude;
        $lat     = $response->latitude;

        $geoLocation = new GeoLocation();
        $geoLocation->setCity($city)
                    ->setCountry($country)
                    ->setRegion($region)
                    ->setLatitude($lat)
                    ->setLongitude($lon);

        return $geoLocation;
    }

} 