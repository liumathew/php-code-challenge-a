<?php

class Bootstrap {

    public $app;

    public function __construct()
    {
        $this->register();
    }

    /**
     * Register services to $app
     */
    public function register()
    {
        $app = new \Silex\Application();

        $app['debug'] = true;

        $app['ipapi_service'] = function () {
            return new Services\IPApiService();
        };
        $app['freegeoip_service'] = function () {
            return new Services\FreeGeoIP();
        };
        $app['weather_service'] = function () {
            return new Services\OpenWeatherMap();
        };

        date_default_timezone_set('UTC');

        $this->app = $app;
    }
}