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
        $this->assertRegexp('/Lets write an email/', $client->getResponse()->getContent());
    }

    public function testComposePageSubmission()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/compose');

        // select the form and fill in some values
        $form = $crawler->selectButton('Send')->form();
        $form['email'] = 'foo@example.com'; // PLEASE only ever use example.com, it is reserved by RFC2606 for this reason
        $form['subject'] = 'This is a test subject.';
        $form['body'] = 'Testing body';
        
        // submit that form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/compose'));
    }

    public function createApplication()
    {
        require __DIR__.'/../../../../../app/app.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();
        $app;

        return $app;
    }
}
