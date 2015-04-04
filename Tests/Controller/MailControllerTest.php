<?php

namespace Incognito\SilextalkSilexDemo\Tests\Controller;

use Silex\WebTestCase;

class MailControllerTest extends WebTestCase
{
    public function testComposePage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/compose');

        $this->assertTrue($client->getResponse()->isOk());
    }

    public function testSendingPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('POST', '/send');

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function createApplication()
    {
        require __DIR__.'/../../app.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();
        $app;

        return $app;
    }
}
