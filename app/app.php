<?php

require_once __DIR__.'/../vendor/autoload.php';

use Incognito\SilextalkSilexDemo\Controller\MailerControllerProvider;
use Silex\Application;

$app = new Application();

$app->mount('/', new MailerControllerProvider($app));

$app->run();
