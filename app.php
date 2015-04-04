<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

$app->get('/compose', function (Silex\Application $app)  {

    // TODO add twig

    return new Response('Html content', 200);
});

$app->post('/send', function (Request $request) {
    //$message = $request->get('body');

    // TODO send email

    // TODO redirect

    return new Response('Sent', 201);
});

$app->run();
