<?php

/*
 * @package     XT Twilio for Joomla
 *
 * @author      Extly, CB. <team@extly.com>
 * @copyright   Copyright (c)2007-2019 Extly, CB. All rights reserved.
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 * @see         https://www.extly.com
 */

namespace XTTwilio\Infrastructure\Service\Twilio;

use Extly\Infrastructure\Creator\CreatorTrait;

class Task
{
    use CreatorTrait;

    public $phoneNumberInformation;

    public $callCenterTask;

    public $message;

    public $firstName;

    public function __construct($phoneNumberInformation, $callCenterTask, $message = null, $firstName = null)
    {
        $this->phoneNumberInformation = $phoneNumberInformation;
        $this->callCenterTask = $callCenterTask;
        $this->message = $message;
        $this->firstName = $firstName;
    }

    public function getRichPhoneNumber()
    {
        return $this->phoneNumberInformation->countryCode.' - '.
            $this->phoneNumberInformation->nationalFormat.' - '.
            $this->phoneNumberInformation->carrier['name'];
    }

    public function getE164PhoneNumber()
    {
        return $this->phoneNumberInformation->phoneNumber;
    }

    public function getSMSMessage()
    {
        return $this->message.' - '.$this->firstName.' ( '.$this->getRichPhoneNumber().' )';
    }
}
