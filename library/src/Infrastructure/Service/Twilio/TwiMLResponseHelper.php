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
use Joomla\CMS\Uri\Uri as CMSUri;

class TwiMLResponseHelper
{
    use CreatorTrait;

    const PARAM_SCREEN_FOR_MACHINE_RESPONSE_URL = 'screen-for-machine-response-url';

    const PARAM_AGENT_PHONE_NUMBER_FROM = 'agent-phone-number-from';

    const CLICK2CALL_RESPONSE_OUTBOUND = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<Response>
    <Dial>
        <Number url="SCREEN_FOR_MACHINE_RESPONSE_URL">
            AGENT_PHONE_NUMBER_FROM
        </Number>
    </Dial>
    <Say>The call failed or the agent hung up. Goodbye.</Say>
</Response>
XML;

    const CLICK2CALL_RESPONSE_SCREEN_FOR_MACHINE = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<Response>
    <Say>Connecting</Say>
</Response>
XML;

    public function getOutboundResponse($agentPhoneNumber)
    {
        $buffer = self::CLICK2CALL_RESPONSE_OUTBOUND;
        $buffer = str_replace('SCREEN_FOR_MACHINE_RESPONSE_URL', $this->getTwiMLResponseScreenForMachineUrl(), $buffer);
        $buffer = str_replace('AGENT_PHONE_NUMBER_FROM', $agentPhoneNumber, $buffer);

        return $buffer;
    }

    public function getScreenForMachineResponse()
    {
        return self::CLICK2CALL_RESPONSE_SCREEN_FOR_MACHINE;
    }

    public function getTwiMLResponseScreenForMachineUrl($rootUri = null)
    {
        return ($rootUri ? $rootUri : CMSUri::root()).
            'index.php?option=com_ajax&plugin=xttwilio&task=getTwiMLResponseScreenForMachine&format=raw';
    }
}
