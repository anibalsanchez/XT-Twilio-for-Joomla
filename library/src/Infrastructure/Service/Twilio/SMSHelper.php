<?php

/*
 * @package     XT Twilio for Joomla
 *
 * @author      Extly, CB. <team@extly.com>
 * @copyright   Copyright (c)2007-2018 Extly, CB. All rights reserved.
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 * @see         https://www.extly.com
 */

namespace XTTwilio\Infrastructure\Service\Twilio;

use Extly\Infrastructure\Creator\CreatorTrait;
use Twilio\Rest\Client as TwilioRest;

class SMSHelper
{
    use CreatorTrait;

    const PARAM_MESSAGE = 'message';

    const PARAM_FIRST_NAME = 'first-name';

    const PARAM_PHONE_NUMBER_FROM = 'phone-number-from';

    protected $accountSid;

    protected $authToken;

    protected $phoneNumber;

    public function __construct($accountSid, $authToken, $phoneNumber)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->phoneNumber = $phoneNumber;
    }

    public function sendSms($message, $firstName, $phoneNumberTo)
    {
        if (empty($message)) {
            return false;
        }

        if (empty($firstName)) {
            return false;
        }

        if (empty($phoneNumberTo)) {
            return false;
        }

        $client = new TwilioRest($this->accountSid, $this->authToken);
        $response = $client->messages->create(
            $phoneNumberTo,
            [
                'from' => $this->phoneNumber,
                'body' => $message.' - '.$firstName.' ( '.$phoneNumberTo.' )',
            ]
        );

        return $response;
    }
}
