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

class TaskRouterHelper extends TwilioHelperAbstract
{
    public function createsTask($workspace, $task = [])
    {
        return $this->getClient()->taskrouter->v1->workspaces($workspace)
            ->tasks
            ->create($task);
    }

    public function retrieveTask($workspace, $taskSid)
    {
        return $this->getClient()->taskrouter->v1->workspaces($workspace)
            ->tasks($taskSid)
            ->fetch();
    }
}
