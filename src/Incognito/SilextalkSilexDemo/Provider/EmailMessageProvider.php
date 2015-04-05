<?php

namespace Incognito\SilextalkSilexDemo\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Incognito\SilextalkSilexDemo\Model\EmailMessageFactory;

class EmailMessageProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['email_factory'] = $app->share(function () {
            return new EmailMessageFactory();
        });
    }

    public function boot(Application $app)
    {
        // This provider does not execute any code when booting
    }
}
