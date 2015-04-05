<?php

namespace Incognito\SilextalkSilexDemo;

use Incognito\SilextalkSilexDemo\Provider\EmailMessageProvider;
use Incognito\SilextalkSilexDemo\Controller\MailerControllerProvider;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\Validator\Mapping\ClassMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\YamlFileLoader;

class SilextalkSilexDemoServiceRegistry
{
    static function boot(Application $app)
    {
        $app->register(new EmailMessageProvider());
        $app->register(new UrlGeneratorServiceProvider());
        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/Resources/views',
        ));

        $app->register(new ValidatorServiceProvider());

        $app['mailer.controller'] = $app->share(function () {
            return new MailerControllerProvider();
        });

        $app['validator.mapping.class_metadata_factory'] = new ClassMetadataFactory(
            new YamlFileLoader(__DIR__.'/Model/validation.yml')
        );
    }
}
