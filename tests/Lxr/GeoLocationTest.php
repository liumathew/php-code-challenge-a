<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 02/02/17
 * Time: 11:49 PM
 */

namespace Tests\Lxr;


use Silex\WebTestCase;

class GeoLocationTest extends WebTestCase{

    public function createApplication()
    {
        return require __DIR__ . '/../../web/index_dev.php';
    }

    public function setUp() {
        parent::setUp();
    }
    protected function tearDown() {
    }

    public function testGeoLocationWithIPAndWithService()
    {
        $client = $this->createClient();
        $client->request('GET',
            'http://127.0.0.1/geolocation/23.44.22.22?service=freegeoip');
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
        $json = $client->getResponse()->getContent();
        $data = json_decode($json,1);

        $this->assertEquals('23.44.22.22', $data['ip']);
        $this->assertEquals('freegeoip', $data['geo']['service']);
        $this->assertArrayHasKey('city',$data['geo']);
        $this->assertArrayHasKey('region',$data['geo']);
        $this->assertArrayHasKey('country',$data['geo']);
    }

    public function testGeoLocationWithoutIPAndWithoutService()
    {
        $client = $this->createClient();
        $client->request('GET',
            'http://127.0.0.1/geolocation/');
        $this->assertEquals($client->getResponse()->getStatusCode(), 302);

        $client->followRedirect();

        $json = $client->getResponse()->getContent();
        $data = json_decode($json,1);

        $this->assertEquals('8.8.8.8', $data['ip']);
        $this->assertEquals('ip-api', $data['geo']['service']);
        $this->assertArrayHasKey('city',$data['geo']);
        $this->assertArrayHasKey('region',$data['geo']);
        $this->assertArrayHasKey('country',$data['geo']);
    }
} 