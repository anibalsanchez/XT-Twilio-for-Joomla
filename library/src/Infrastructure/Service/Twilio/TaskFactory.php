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

namespace XTTwilio\Infrastructure\Service\Twilio;

use Extly\Infrastructure\Creator\CreatorTrait;

final class TaskFactory
{
    use CreatorTrait;

    private $accountSid;

    private $authToken;

    private $workspaceSid;

    private $workflowSid;

    public function __construct($accountSid, $authToken, $workspaceSid, $workflowSid)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->workspaceSid = $workspaceSid;
        $this->workflowSid = $workflowSid;
    }

    public function defineNewTask($phoneNumberFrom, $message = null, $firstName = null)
    {
        $lookupResult = $this->retrieveLookupPhoneNumber($phoneNumberFrom);
        $flexTask = $this->createFlexTask($lookupResult->phoneNumber, $message, $firstName);

        return Task::create($lookupResult, $flexTask, $message, $firstName);
    }

    protected function retrieveLookupPhoneNumber($phoneNumberFrom)
    {
        return LookupHelper::create($this->accountSid, $this->authToken)
            ->retrieve($phoneNumberFrom);
    }

    protected function createFlexTask($phoneNumber, $message = null, $firstName = null)
    {
        $attributes = [
            'Phone Number' => $phoneNumber,
        ];

        if ($message) {
            $attributes['Message'] = $message;
        }

        if ($firstName) {
            $attributes['Name'] = $firstName;
        }

        return TaskRouterHelper::create($this->accountSid, $this->authToken)
            ->createsTask($this->workspaceSid, [
                'attributes' => json_encode((object) $attributes),
                'workflowSid' => $this->workflowSid,
            ]);
    }
}
