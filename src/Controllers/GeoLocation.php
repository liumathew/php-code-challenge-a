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

        $controllers->get('/',function () use ($app) {

            return new Response(json_encode
            (
                [
                    'ip'=>'8.8.8.8',
                    'geo'=>[
                        'service'=>'ip-api',
                        'city'   =>'Mountain View'
                    ],
                ])
            );
        });

        return $controllers;
    }
} 