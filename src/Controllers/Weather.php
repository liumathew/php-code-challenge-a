<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 01/02/17
 * Time: 10:44 PM
 */

namespace Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Weather implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/',function (Request $request) use ($app) {

            $ip = $request->getClientIp();

            // Use default IP if the IP is private
            if(preg_match('/(^127\.)|
                        (^10\.)|
                        (^172\.1[6-9]\.)|(^172\.2[0-9]\.)|(^172\.3[0-1]\.)|
                        (^192\.168\.)/',$ip)){
                $ip = '8.8.8.8';
            }
            return $app->redirect("/weather/$ip",302);
        });

        $controllers->get('/{ip}',function (Request $request, $ip) use ($app) {

            /* @var \Services\FreeGeoIP $geoService */
            $geoService = $app['freegeoip_service'];
            $geoLocation = $geoService->getGeoLocation($ip);
            $lat = $geoLocation->getLatitude();
            $lon = $geoLocation->getLongitude();

            /* @var \Services\OpenWeatherMap $service */
            $service = $app['weather_service'];

            $weather = $service->getWeather($lat,$lon);
            return new Response(json_encode
                (
                    [
                        'ip'=>$ip,
                        'city'=>$weather->getCity(),
                        'temperature'=>[
                            'current'   => $weather->getTemperature()->getCurrent(),
                            'low'        => $weather->getTemperature()->getLow(),
                            'high'       => $weather->getTemperature()->getHigh()
                        ],
                        'wind'=>[
                            'speed'     => $weather->getWind()->getSpeed(),
                            'direction' => $weather->getWind()->getDirection(),
                        ],
                    ])
            );
        });

        return $controllers;
    }
} 