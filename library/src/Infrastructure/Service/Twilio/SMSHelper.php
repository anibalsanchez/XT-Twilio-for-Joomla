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

class SMSHelper extends TwilioHelperAbstract
{
    const PARAM_MESSAGE = 'message';

    const PARAM_FIRST_NAME = 'first-name';

    const PARAM_PHONE_NUMBER_FROM = 'phone-number-from';

    protected $phoneNumber;

    public function __construct($accountSid, $authToken, $phoneNumber)
    {
        parent::__construct($accountSid, $authToken);

        $this->phoneNumber = $phoneNumber;
    }

    public function sendSms($message, $phoneNumberTo)
    {
        if (empty($message)) {
            return false;
        }

        if (empty($phoneNumberTo)) {
            return false;
        }

        $response = $this->getClient()->messages->create(
            $phoneNumberTo,
            [
                'from' => $this->phoneNumber,
                'body' => $message,
            ]
        );

        return $response;
    }
}
