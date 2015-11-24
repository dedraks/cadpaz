<?php

namespace CadpazBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CasoControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/caso/{pessoa_id}/new');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/caso/{id}/view');
    }

}
