<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Incognito\SilextalkSilexDemo\SilextalkSilexDemoServiceRegistry;

$app = new Application();

SilextalkSilexDemoServiceRegistry::boot($app);

$app->mount('/', $app['mailer.controller']);

$app->run();
