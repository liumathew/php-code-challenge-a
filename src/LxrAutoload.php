<?php

class LxrAutoload
{
    static public function getLoader() {
        $loader = require_once __DIR__ . '/../vendor/autoload.php';

        $loader->add('Controllers', __DIR__ . '/../src/' );
        $loader->add('Connection', __DIR__ . '/../src/' );
        $loader->add('Services', __DIR__ . '/../src/' );
        $loader->add('Lxr', __DIR__ . '/../src/' );

        return $loader;
    }

}