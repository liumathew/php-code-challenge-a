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

class GeoLocation implements ControllerProviderInterface
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

            return $app->redirect("/geolocation/$ip",302);
        });

        $controllers->get('/{ip}',function (Request $request, $ip) use ($app) {

            $type = $request->query->get('service');

            if($type=='freegeoip'){
                /* @var \Services\FreeGeoIP $service */
                $service = $app['freegeoip_service'];
            }
            else{
                $type = 'ip-api';
                /* @var \Services\IPApiService $service */
                $service = $app['ipapi_service'];
            }

            $geoLocation = $service->getGeoLocation($ip);
            return new Response(json_encode
            (
                [
                    'ip'=>$ip,
                    'geo'=>[
                        'service' => $type,
                        'city'    => $geoLocation->getCity(),
                        'region'  => $geoLocation->getRegion(),
                        'country' => $geoLocation->getCountry()
                    ],
                ])
            );
        });

        return $controllers;
    }
} 