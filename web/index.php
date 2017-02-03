<?php

error_reporting(E_ALL);

require('../src/LxrAutoload.php');
$loader = LxrAutoload::getLoader();

require("../src/Bootstrap.php");
$bootstrap = new Bootstrap();
/** @var \Silex\Application $app */
$app = $bootstrap->app;

$app->mount('/geolocation', new \Controllers\GeoLocation());
$app->mount('/weather', new \Controllers\Weather());

$app->run();
