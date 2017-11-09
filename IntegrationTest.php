<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client;

class IntegrationTest extends TestCase
{
    /** @var Process */
    private static $process;

    public static function setUpBeforeClass()
    {
        self::$process = new Process("php -S localhost:8080 -t .");
        self::$process->start();

        usleep(100000); //wait for server to get going
    }

    public static function tearDownAfterClass()
    {
        self::$process->stop();
    }

    public function test404()
    {
        $client = new Client(['http_errors' => false]);

        $response = $client->request("GET", "http://localhost:8080");
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function test200()
    {
        $client = new Client(['http_errors' => false]);

        $response = $client->request("GET", "http://localhost:8080/testpage/");
        $this->assertEquals(200, $response->getStatusCode());
    }
}
