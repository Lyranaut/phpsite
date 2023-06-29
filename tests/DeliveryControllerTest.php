<?php

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeliveryControllerTest extends WebTestCase
{
    public function testCalculatePrice()
    {
        $client = static::createClient();

        $data = [
            'weight' => 5,
            'slug' => 'TransCompany'
        ];

        $client->request('POST', '/api/calculate-price', [], [], [], json_encode($data));
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('price', $responseData);
        $this->assertIsNumeric($responseData['price']);
    }
}