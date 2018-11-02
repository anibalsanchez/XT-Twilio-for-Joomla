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

use XTTwilio\Infrastructure\Service\Twilio\Click2CallHelper;
use PHPUnit\Framework\TestCase;

class Click2CallHelperTest extends TestCase
{
    public function testCallTest()
    {
        $click2CallHelper = Click2CallHelper::create(TEST_ACCOUNT_SID, TEST_AUTH_TOKEN, TEST_TWILIO_PHONE_NUMBER);
        $result = $click2CallHelper->call(TEST_USER_PHONE_NUMBER);

        $this->assertTrue(false);
    }
}
