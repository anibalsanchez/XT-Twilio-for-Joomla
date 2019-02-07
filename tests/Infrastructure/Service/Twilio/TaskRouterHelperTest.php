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
use XTTwilio\Infrastructure\Service\Twilio\TaskRouterHelper;

/**
 * @coversNothing
 */
class TaskRouterHelperTest extends TestCase
{
    public function testCreatesTask()
    {
        $task = TaskRouterHelper::create(TEST_ACCOUNT_SID, TEST_AUTH_TOKEN)
            ->createsTask(TEST_FLEX_WORKSPACE_SID, [
                'attributes' => '{
                    "glossary": {
                        "title": "example glossary",
                        "GlossDiv": {
                            "title": "S",
                            "GlossList": {
                                "GlossEntry": {
                                    "ID": "SGML",
                                    "SortAs": "SGML",
                                    "GlossTerm": "Standard Generalized Markup Language",
                                    "Acronym": "SGML",
                                    "Abbrev": "ISO 8879:1986",
                                    "GlossDef": {
                                        "para": "A meta-markup language, used to create markup languages such as DocBook.",
                                        "GlossSeeAlso": ["GML", "XML"]
                                    },
                                    "GlossSee": "markup"
                                }
                            }
                        }
                    }
                }',
                'workflowSid' => TEST_FLEX_WORKFLOW_SID,
            ]);

        $this->assertStringStartsWith('WT', $task->sid);
        $this->assertStringStartsWith('pending', $task->assignmentStatus);

        $task = TaskRouterHelper::create(TEST_ACCOUNT_SID, TEST_AUTH_TOKEN)
            ->retrieveTask(TEST_FLEX_WORKSPACE_SID, $task->sid);

        $this->assertStringStartsWith('WT', $task->sid);
        $attributes = json_decode($task->attributes);
        $this->assertStringStartsWith('example glossary', $attributes->glossary->title);
    }
}
