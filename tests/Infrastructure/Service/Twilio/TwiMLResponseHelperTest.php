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

use PHPUnit\Framework\TestCase;
use XTTwilio\Infrastructure\Service\Twilio\TwiMLResponseHelper;

/**
 * @coversNothing
 */
class TwiMLResponseHelperTest extends TestCase
{
    public function testGetOutboundResponse()
    {
        $response = TwiMLResponseHelper::create()->getOutboundResponse('34123456789');

        $this->assertContains('34123456789', $response);
    }
}
