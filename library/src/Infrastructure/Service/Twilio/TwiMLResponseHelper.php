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
use Twilio\Twiml;

class TwiMLResponseHelper
{
    use CreatorTrait;

    public function getOutboundResponse($agentPhoneNumber)
    {
        $sayMessage = 'Thanks for contacting our sales department. Our next available representative will take your call.';
        $twiml = new Twiml();
        $twiml->say($sayMessage, ['voice' => 'alice']);
        $twiml->dial($agentPhoneNumber);

        return (string) $twiml;
    }
}
