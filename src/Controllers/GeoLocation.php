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

            return $app->redirect("/geolocation/$ip",302);
        });

        $controllers->get('/{ip}',function (Request $request, $ip) use ($app) {

            $type = $request->query->get('service');

            if($type=='ip-api'){
                /* @var \Services\IPApiService $service */
                $service = $app['ipapi_service'];
            }
            else{
                $type = 'freegeoip';
                /* @var \Services\FreeGeoIP $service */
                $service = $app['freegeoip_service'];
            }

            $geoLocation = $service->getGeoLocation($ip);
            return new Response(json_encode
            (
                [
                    'ip'=>$ip,
                    'geo'=>[
                        'service'=>$type,
                        'city'   =>$geoLocation->getCity(),
                        'region' =>$geoLocation->getRegion(),
                        'country'=>$geoLocation->getCountry()
                    ],
                ])
            );
        });

        return $controllers;
    }
} 