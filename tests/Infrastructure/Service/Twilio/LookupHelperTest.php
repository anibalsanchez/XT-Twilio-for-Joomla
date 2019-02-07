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

namespace tests\library\XTTwilio\Infrastructure\Service\Twilio;

use PHPUnit\Framework\TestCase;
use XTTwilio\Infrastructure\Service\Twilio\LookupHelper;

/**
 * @coversNothing
 */
class LookupHelperTest extends TestCase
{
    public function testRetrieve()
    {
        $phoneNumberInformation = LookupHelper::create(TEST_ACCOUNT_SID, TEST_AUTH_TOKEN)->retrieve(TEST_USER_PHONE_NUMBER);

        /*         $this->assertSame('US', $phoneNumberInformation->countryCode);
                $this->assertSame('+15108675310', $phoneNumberInformation->phoneNumber);
                $this->assertSame('(510) 867-5310', $phoneNumberInformation->nationalFormat);
                $this->assertSame('Sprint Spectrum, L.P.', $phoneNumberInformation->carrier['name']); */

        $this->assertSame('ES', $phoneNumberInformation->countryCode);
        $this->assertStringStartsWith('+', $task->phoneNumberInformation->phoneNumber);
        $this->assertSame('684 64 40 96', $phoneNumberInformation->nationalFormat);
        $this->assertSame('VODAFONE ENABLER ESPANA, S.L.', $phoneNumberInformation->carrier['name']);
    }
}
