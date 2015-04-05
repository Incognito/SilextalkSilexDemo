<?php

namespace Incognito\SilextalkSilexDemo\Controller;

use Incognito\SilextalkSilexDemo\Provider\EmailMessageProvider;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\Validator\Mapping\ClassMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\YamlFileLoader;

class MailerControllerProvider implements ControllerProviderInterface
{
    public function __construct(Application $app) {
        $app->register(new EmailMessageProvider());
        $app->register(new UrlGeneratorServiceProvider());
        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/../Resources/views',
        ));

        $app->register(new ValidatorServiceProvider());

        $app['validator.mapping.class_metadata_factory'] = new ClassMetadataFactory(
            new YamlFileLoader(__DIR__.'/../Model/EmailMessageValidation.yml')
        );
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
