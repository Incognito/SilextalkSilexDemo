<?php

namespace Incognito\SilextalkSilexDemo\Model;

use Symfony\Component\HttpFoundation\Request;

class EmailMessageFactory
{
    static public function createFromRequest(Request $request)
    {
        $address = $request->get('email');
        $subject = $request->get('subject');
        $body = $request->get('body');

        return self::createEmail($address, $subject, $body);
    }

    static public function createEmail($address, $subject, $body)
    {
        $emailMessage = new EmailMessage($address, $subject, $body);

        return $emailMessage;
    }
}
