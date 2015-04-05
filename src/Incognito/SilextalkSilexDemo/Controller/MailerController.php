<?php

namespace Incognito\SilextalkSilexDemo\Controller;

use Silex\Application;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MailerController
{
    public function composeAction(Application $app) {
          $twig = $app['twig'];

          return new Response($twig->render('compose.html.twig'));
    }

    public function sendAction(Application $app, Request $request)
    {
          $urlGenerator = $app['url_generator'];
          $emailFactory = $app['email_factory'];

          $email = $emailFactory::createFromRequest($request);

          // TODO send email

          return $app->redirect($urlGenerator->generate('mailer_compose'));
    }
}
