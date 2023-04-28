<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RatingControllerTest extends WebTestCase
{
    public function testPostRating(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/rating/', [
                'score' => '5',
                'feedback'=> '1',
                'ratingQuestion'=>'1'
        ]);

        $response = json_decode($client->getResponse()->getContent());
        $this->assertNotEmpty($response->payload->ratings);
        $ratings = $response->payload->ratings;
        $this->assertEquals(5, $ratings->score);
    }

    public function testUpdateRating(): void
    {
        $client = static::createClient();
        $client->jsonRequest('PUT', '/rating/1', [
            'score' => '3',
            'feedback'=> '1',
            'ratingQuestion'=>'1'
        ]);

        $response = json_decode($client->getResponse()->getContent());
        $this->assertNotEmpty($response->payload->ratings);
        $rating = $response->payload->ratings;
        $this->assertEquals(3, $rating->score);
    }


    public function testGetRating(): void
    {
        $client = static::createClient();
        $client->request('GET', '/rating/');

        $response = json_decode($client->getResponse()->getContent());
        $this->assertNotEmpty($response->payload->ratings);

    }

}
