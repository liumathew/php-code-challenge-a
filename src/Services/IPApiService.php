<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 02/02/17
 * Time: 12:18 AM
 */

namespace Services;

use Connection\Connection;
use Lxr\GeoLocation;

class IPApiService
{
    function getGeoLocation($ip){
        $connection = new Connection();
        $response = $connection->curlRequest("http://ip-api.com/json/$ip");

        $city = $response->city;
        $country = $response->country;
        $region = $response->region;

        $geoLocation = new GeoLocation();
        $geoLocation->setCity($city)
            ->setCountry($country)
            ->setRegion($region);

        return $geoLocation;
    }
}