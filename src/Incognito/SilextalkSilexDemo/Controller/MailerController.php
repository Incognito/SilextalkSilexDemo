<?php

namespace Incognito\SilextalkSilexDemo\Controller;

use Silex\Application;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MailerController
{
    public function composeAction(Application $app) {
          // TODO add twig

          return new Response('Html content', 200);
    }

    public function sendAction(Application $app, Request $request) {
          $urlGenerator = $app['url_generator'];

          //$message = $request->get('body');

          // TODO send email

          return $app->redirect($urlGenerator->generate('mailer_compose'));
    }
}
