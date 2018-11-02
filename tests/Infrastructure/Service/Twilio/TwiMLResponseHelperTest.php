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

namespace tests\library\XTTwilio\Infrastructure\Service\Twilio;

use XTTwilio\Infrastructure\Service\Twilio\TwiMLResponseHelper;
use PHPUnit\Framework\TestCase;

class TwiMLResponseHelperTest extends TestCase
{
    public function testGetOutboundResponse()
    {
        $response = TwiMLResponseHelper::create()->getOutboundResponse('https://handler.twilio.com/twiml/qwerty', '+34123456789');

        $this->assertContains('url="https://handler.twilio.com', $response);
        $this->assertContains('+34123456789', $response);
    }

    public function testGetScreenForMachineResponse()
    {
        $response = TwiMLResponseHelper::create()->getScreenForMachineResponse();

        $this->assertContains('<Say>Connecting</Say>', $response);
    }
}
