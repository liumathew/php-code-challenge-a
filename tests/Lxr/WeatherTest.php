<?php

namespace Tests\Lxr;

use Silex\WebTestCase;

class WeatherTest extends WebTestCase{

    public function createApplication()
    {
        return require __DIR__ . '/../../web/index_dev.php';
    }

    public function setUp() {
        parent::setUp();
    }
    protected function tearDown() {
    }

    public function testWeatherWithIP()
    {
        $client = $this->createClient();
        $client->request('GET',
            'http://127.0.0.1/weather/23.44.22.22');
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
        $json = $client->getResponse()->getContent();
        $data = json_decode($json,1);

        $this->assertEquals('23.44.22.22', $data['ip']);

        $this->assertArrayHasKey('city',$data);
        $this->assertArrayHasKey('temperature',$data);
        $this->assertArrayHasKey('current',$data['temperature']);
        $this->assertArrayHasKey('low',$data['temperature']);
        $this->assertArrayHasKey('high',$data['temperature']);

        $this->assertArrayHasKey('wind',$data);
        $this->assertArrayHasKey('speed',$data['wind']);
        $this->assertArrayHasKey('direction',$data['wind']);
    }

    public function testWeatherWithoutIP()
    {
        $client = $this->createClient();
        $client->request('GET',
            'http://127.0.0.1/weather/');
        $this->assertEquals($client->getResponse()->getStatusCode(), 302);

        $client->followRedirect();

        $json = $client->getResponse()->getContent();
        $data = json_decode($json,1);

        $this->assertEquals('8.8.8.8', $data['ip']);

        $this->assertArrayHasKey('city',$data);
        $this->assertArrayHasKey('temperature',$data);
        $this->assertArrayHasKey('current',$data['temperature']);
        $this->assertArrayHasKey('low',$data['temperature']);
        $this->assertArrayHasKey('high',$data['temperature']);

        $this->assertArrayHasKey('wind',$data);
        $this->assertArrayHasKey('speed',$data['wind']);
        $this->assertArrayHasKey('direction',$data['wind']);
    }
}