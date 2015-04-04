<?php

namespace Incognito\SilextalkSilexDemo\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MailerController
{
   public function __construct()
   {
       // Nothing to inject
   }

   public function composeAction(Application $app)  {
        // TODO add twig

        return new Response('Html content', 200);
   }

   public function sendAction(Request $request) {
        //$message = $request->get('body');

        // TODO send email

        // TODO redirect

        return new Response('Sent', 201);
   }
}

