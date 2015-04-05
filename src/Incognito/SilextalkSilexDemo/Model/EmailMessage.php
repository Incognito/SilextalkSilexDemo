<?php

namespace Incognito\SilextalkSilexDemo\Model;

class EmailMessage
{
    /*
     * string
     */
    private $toAddress;

    /*
     * string
     */
    private $subject;

    /*
     * string
     */
    private $body;

    public function __construct($toAddress, $subject, $body)
    {
        $this->toAddress = $toAddress;
        $this->subject = $subject;
        $this->body = $body;
    }
}
