<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 02/02/17
 * Time: 12:19 AM
 */

namespace Services;


use Connection\Connection;
use Lxr\GeoLocation;

class FreeGeoIP {

    function getGeoLocation($ip){
        $connection = new Connection();
        $response = $connection->curlRequest("http://freegeoip.net/json/$ip");

        $city = $response->city;
        $country = $response->country_name;
        $region = $response->region_code;

        $geoLocation = new GeoLocation();
        $geoLocation->setCity($city)
            ->setCountry($country)
            ->setRegion($region);

        return $geoLocation;
    }

} 