<?php

namespace Incognito\SilextalkSilexDemo\Model;

class Mailer
{
    private $sender;
    private $swiftmailer;

    public function __construct(\Swift_Mailer $swiftmailer, $sender)
    {
        $this->swiftmailer = $swiftmailer;
        $this->sender = $sender;
    }

    public function send(EmailMessage $emailMessage)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($emailMessage->getSubject())
            ->setFrom(array($this->sender))
            ->setTo(array($emailMessage->getToAddress()))
            ->setBody($emailMessage->getBody())
        ;

        $this->swiftmailer->send($message);
    }
}
