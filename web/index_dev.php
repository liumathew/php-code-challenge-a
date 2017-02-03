<?php

require_once __DIR__ . '/../vendor/composer/autoload_real.php';

$loader = ComposerAutoloaderInit2d4ccc21ddaaab487c157d559c09813d::getLoader();
$loader->add('Controllers', __DIR__ . '/../src/' );
$loader->add('Connection', __DIR__ . '/../src/' );
$loader->add('Services', __DIR__ . '/../src/' );
$loader->add('Lxr', __DIR__ . '/../src/' );

require_once("../src/Bootstrap.php");
$bootstrap = new Bootstrap();
/** @var \Silex\Application $app */
$app = $bootstrap->app;

$app->mount('/geolocation', new \Controllers\GeoLocation());
$app->mount('/weather', new \Controllers\Weather());

return $app;
