<?php

namespace Incognito\SilextalkSilexDemo\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\Provider\UrlGeneratorServiceProvider;

class MailerControllerProvider implements ControllerProviderInterface
{
    public function __construct(Application $app) {
        $app->register(new UrlGeneratorServiceProvider());
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('compose', 'Incognito\SilextalkSilexDemo\Controller\MailerController::composeAction')
            ->bind('mailer_compose')
        ;

        $controllers->post('send', 'Incognito\SilextalkSilexDemo\Controller\MailerController::sendAction')
            ->bind('mailer_send')
        ;

        return $controllers;
    }
}
