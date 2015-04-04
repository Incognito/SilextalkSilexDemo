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

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/compose'));
    }

    public function createApplication()
    {
        require __DIR__.'/../../app/app.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();
        $app;

        return $app;
    }
}
