<?php

namespace Incognito\SilextalkSilexDemo\Test\Model;

use Incognito\SilextalkSilexDemo\Model\EmailMessageFactory;

class EmailMessageFactoryTest extends \PHPUnit_Framework_TestCase
{
      public function testEmailCreatedSuccessfully()
      {
          $address = "foo@example.com";
          $subject = "The subject";
          $body = "Some body";

          $emailMessage = EmailMessageFactory::createEmail(
              $address,
              $subject,
              $body
          );

          $this->assertInstanceOf('Incognito\SilextalkSilexDemo\Model\EmailMessage', $emailMessage);
      }
}
