<?php

namespace Incognito\SilextalkSilexDemo;

use Incognito\SilextalkBase\Model\Mailer;
use Incognito\SilextalkBase\Provider\EmailMessageProvider;
use Incognito\SilextalkSilexDemo\Controller\MailerControllerProvider;
use Silex\Application;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\Validator\Mapping\ClassMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\YamlFileLoader;

class SilextalkSilexDemoServiceRegistry
{
  
    const DEFAULT_SENDER = "bar@example.com";

    // FIXME service namespaces are over-lapping. Should have prefixed with own ns.
    static function boot(Application $app)
    {
        $app->register(new SwiftmailerServiceProvider());

        $app['swiftmailer.options'] = array(
            'host' => 'host',
            'port' => '25',
            'username' => 'username',
            'password' => 'password',
            'encryption' => null,
            'auth_mode' => null
        );

        $app->register(new EmailMessageProvider());
        $app->register(new UrlGeneratorServiceProvider());
        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/Resources/views',
        ));

        $app->register(new ValidatorServiceProvider());

        $app['mailer.controller'] = $app->share(function () {
            return new MailerControllerProvider();
        });

        $app['mailer.mailer'] = $app->share(function () use ($app) {
            return new Mailer($app['mailer'], self::DEFAULT_SENDER);
        });

        $app['validator.mapping.class_metadata_factory'] = new ClassMetadataFactory(
            new YamlFileLoader(__DIR__.'/Resources/config/validation.yml')
        );
    }
}
