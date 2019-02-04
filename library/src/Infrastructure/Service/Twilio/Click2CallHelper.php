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

class Click2CallHelper extends TwilioHelperAbstract
{
    const PARAM_PHONE_NUMBER_TO = 'phone-number-to';

    protected $phoneNumberFrom;

    protected $rootUri;

    public function __construct($accountSid, $authToken, $phoneNumberFrom, $rootUri)
    {
        parent::__construct($accountSid, $authToken);

        $this->phoneNumberFrom = $phoneNumberFrom;
        $this->rootUri = $rootUri;
    }

    public function call($phoneNumberTo)
    {
        if (empty($phoneNumberTo)) {
            return false;
        }

        $response = $this->getClient()->calls->create(
            $phoneNumberTo,
            $this->phoneNumberFrom,
            [
                'url' => $this->rootUri.
                    'index.php?option=com_ajax&plugin=xttwilio&task=getTwiMLResponseOutbound&format=raw',
            ]
        );

        return $response;
    }
}
