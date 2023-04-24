<?php

namespace App\Tests\Controller;

use App\Repository\HomeAvailabilityRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomeDetailEndpoint(): void
    {
        $client = static::createClient();
        $client->request('GET', '/home/1');

        $response = json_decode($client->getResponse()->getContent());
        $this->assertNotEmpty($response->payload->home);
        $home = $response->payload->home;
        $this->assertEquals(1, $home->id);
    }
}
