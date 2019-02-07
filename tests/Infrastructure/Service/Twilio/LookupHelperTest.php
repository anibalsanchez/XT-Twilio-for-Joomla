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

        $this->assertSame(TEST_USER_COUNTRY_CODE, $phoneNumberInformation->countryCode);
        $this->assertStringStartsWith('+', $phoneNumberInformation->phoneNumber);
        $this->assertSame(TEST_USER_NATIONAL_FORMAT, $phoneNumberInformation->nationalFormat);
        $this->assertSame(TEST_USER_CARRIER_NAME, $phoneNumberInformation->carrier['name']);
    }
}
