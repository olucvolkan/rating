<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeedbackControllerTest extends WebTestCase
{
    public function testPostFeedback(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/feedback/', [
                'comment' => 'lorem ipsum',
                'project'=> '1',
                'client'=>'1'
        ]);

        $response = json_decode($client->getResponse()->getContent());
        $this->assertNotEmpty($response->payload->feedback);
        $feedback = $response->payload->feedback;
        $this->assertEquals(1, $feedback->client);
    }

    public function testUpdateFeedback(): void
    {
        $client = static::createClient();
        $client->jsonRequest('PUT', '/feedback/1', [
            'comment' => 'lorem ipsum update',
            'project'=> '1',
            'client'=>'2'
        ]);

        $response = json_decode($client->getResponse()->getContent());
        $this->assertNotEmpty($response->payload->feedback);
        $feedback = $response->payload->feedback;
        $this->assertEquals(2, $feedback->client);
    }


    public function testGetFeedback(): void
    {
        $client = static::createClient();
        $client->request('GET', '/feedback/');

        $response = json_decode($client->getResponse()->getContent());
        $this->assertNotEmpty($response->payload->feedbacks);

    }

}
