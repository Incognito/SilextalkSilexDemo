<?php

namespace Incognito\SilextalkSilexDemo\Tests\Controller;

use Silex\WebTestCase;

class MailControllerTest extends WebTestCase
{
    private $mailerLogger;

    public function testComposePage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/compose');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertRegexp('/Lets write an email/', $client->getResponse()->getContent());
    }

    public function testComposePageSubmissionSuccess()
    {
        $mailCollector = $this->mailerLogger;
        $client = $this->createClient();
        $crawler = $client->request('GET', '/compose');

        // select the form and fill in some values
        $form = $crawler->selectButton('Send')->form();
        $form['email'] = 'foo@example.com'; // PLEASE only ever use example.com, it is reserved by RFC2606 for this reason
        $form['subject'] = 'This is a test subject.';
        $form['body'] = 'Testing body';
        
        $this->assertEquals(0, $mailCollector->countMessages());

        // submit that form
        $crawler = $client->submit($form);

        // Check that an e-mail was sent
        // FIXME: The 2 is due to the logger tracker swift transport events
        // FIXME: this test would be better if using the Symfony web test case and profiler
        $this->assertEquals(2, $mailCollector->countMessages());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting e-mail data
        $this->assertInstanceOf('Swift_Message', $message);

        $this->assertEquals('This is a test subject.', $message->getSubject());
        $this->assertEquals('foo@example.com', key($message->getTo()));
        $this->assertEquals('Testing body', $message->getBody());

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/compose'));
    }
    
    public function testComposePageSubmissionFailure()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/compose');

        // select the form and fill in some values
        $form = $crawler->selectButton('Send')->form();
        $form['email'] = 'foobademail';
        $form['subject'] = '';
        $form['body'] = '';
        
        // submit that form
        $crawler = $client->submit($form);

        $mailCollector = $this->mailerLogger;

        $this->assertEquals(0, $mailCollector->countMessages());

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function createApplication()
    {
        require __DIR__.'/../../../../../app/app.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        // Log swiftmailer messages
        $app['mailer.logger'] = $app->share(function() { return new \Swift_Plugins_MessageLogger(); });
        $app['mailer'] = $app->share($app->extend('mailer', function($mailer, $app) {
            $mailer->registerPlugin($app['mailer.logger']);
            return $mailer;
        }));
        $app['swiftmailer.options'] = array();

        $this->mailerLogger = $app['mailer.logger'];
        return $app;
    }

    public function tearDown()
    {
        $this->mailerLogger->clear();
    }
}
