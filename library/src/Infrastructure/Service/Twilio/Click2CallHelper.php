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

class Click2CallHelper
{
    use CreatorTrait;

    const PARAM_PHONE_NUMBER_TO = 'phone-number-to';

    protected $accountSid;

    protected $authToken;

    protected $phoneNumberFrom;

    protected $rootUri;

    public function __construct($accountSid, $authToken, $phoneNumberFrom, $rootUri)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->phoneNumberFrom = $phoneNumberFrom;
    }

    public function call($phoneNumberTo)
    {
        if (empty($phoneNumberTo)) {
            return false;
        }

        $client = new TwilioRest($this->accountSid, $this->authToken);
        $response = $client->calls->create(
            $phoneNumberTo,
            $this->phoneNumberFrom,
            [
                'url' => $rootUri.'index.php?option=com_ajax&plugin=xttwilio&task=getTwiMLResponseOutbound&format=raw',
            ]
        );

        return $response;
    }
}
