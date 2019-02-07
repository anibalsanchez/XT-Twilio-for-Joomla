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
use XTTwilio\Infrastructure\Service\Twilio\TaskFactory;

/**
 * @coversNothing
 */
class TaskFactoryTest extends TestCase
{
    public function testDefineNewTask()
    {
        $taskFactory = TaskFactory::create(TEST_ACCOUNT_SID, TEST_AUTH_TOKEN, TEST_FLEX_WORKSPACE_SID, TEST_FLEX_WORKFLOW_SID);
        $task = $taskFactory->defineNewTask(TEST_USER_PHONE_NUMBER, 'Hi!', 'John');

        $this->assertSame(TEST_USER_COUNTRY_CODE, $task->phoneNumberInformation->countryCode);
        $this->assertStringStartsWith('+', $task->phoneNumberInformation->phoneNumber);
        $this->assertSame(TEST_USER_NATIONAL_FORMAT, $task->phoneNumberInformation->nationalFormat);
        $this->assertSame(TEST_USER_CARRIER_NAME, $task->phoneNumberInformation->carrier['name']);

        $this->assertStringStartsWith('WT', $task->callCenterTask->sid);
    }
}
