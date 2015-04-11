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
        $address = $request->get('email');
        $subject = $request->get('subject');
        $body = $request->get('body');
        $emailMessage = $app['email_factory']::createEmail($address, $subject, $body);

        $validationErrors = $app['validator']->validate($emailMessage);

        if ($validationErrors->count() > 0) {
            return new Response("Nope. That's not valid.", 400);
        }

        $app['mailer.mailer']->send($emailMessage);

        return $app->redirect($app['url_generator']->generate('mailer_compose'));
    }
}
