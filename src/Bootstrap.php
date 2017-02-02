<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 01/02/17
 * Time: 10:49 PM
 */

class Bootstrap {

    public $app;

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        $app = new \Silex\Application();

        $app['debug'] = true;

        date_default_timezone_set('UTC');

        $this->app = $app;
    }
}