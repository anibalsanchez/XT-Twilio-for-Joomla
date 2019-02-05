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
use Twilio\Rest\Client as TwilioRest;

class TwilioHelperAbstract
{
    use CreatorTrait;

    protected $accountSid;

    protected $authToken;

    public function __construct($accountSid, $authToken)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
    }

    protected function getClient()
    {
        $client = new TwilioRest($this->accountSid, $this->authToken);

        return $client;
    }
}
