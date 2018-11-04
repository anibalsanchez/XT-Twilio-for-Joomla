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
use XTTwilio\Infrastructure\Service\Twilio\SMSHelper;

/**
 * @coversNothing
 */
class SMSHelperTest extends TestCase
{
    public function testSendSms()
    {
        $smsHelper = SMSHelper::create(TEST_ACCOUNT_SID, TEST_AUTH_TOKEN, TEST_TWILIO_PHONE_NUMBER);
        $result = $smsHelper->sendSms(TEST_USER_PHONE_NUMBER, 'Test SMSHelperTest/testSendSms: '.rand(0, 999));

        $this->assertNull($result->errorCode);
    }
}
