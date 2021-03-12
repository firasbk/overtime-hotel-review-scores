<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    public function testGetReviewsUrl()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/reviews');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testOvertimeReviewsScoresUrl()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/overtime-reviews-scores/17?from=2019-05-05&to=2019-05-30');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}