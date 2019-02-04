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
        $lookupHelper = LookupHelper::create(TEST_ACCOUNT_SID, TEST_AUTH_TOKEN);
        $phoneNumberInformation = $lookupHelper->retrieve(TEST_USER_PHONE_NUMBER);

        $this->assertSame('US', $phoneNumberInformation->countryCode);
        $this->assertSame('(510) 867-5310', $phoneNumberInformation->nationalFormat);
        $this->assertSame('Sprint Spectrum, L.P.', $phoneNumberInformation->carrier['name']);
    }
}
