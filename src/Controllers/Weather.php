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
            //todo: check ip
            $ip = $request->getClientIp();

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