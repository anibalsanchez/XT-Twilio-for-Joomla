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

namespace tests\plg_ajax_xttwilio;

use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use PHPUnit\Framework\TestCase;
use XTTwilio\Infrastructure\Service\Twilio\Click2CallHelper;
use XTTwilio\Infrastructure\Service\Twilio\SMSHelper;
use XTTwilio\Infrastructure\Service\Twilio\TwiMLResponseHelper;

/**
 * @coversNothing
 */
class PlgAjaxXTTwilioTest extends TestCase
{
    public function testComAjaxSendSMS()
    {
        $response = $this->post(
            J_URI_ROOT.
            'index.php?option=com_ajax&plugin=xttwilio&task=sendsms&format=json',
            [
                SMSHelper::PARAM_PHONE_NUMBER_FROM => TEST_USER_PHONE_NUMBER,
                SMSHelper::PARAM_MESSAGE => 'Test PlgAjaxXTTwilioTest/testComAjaxSendSMS: '.rand(0, 999),
            ]
        );
        $httpStatusCode = $response->getStatusCode();
        $content = (string) $response->getBody();
        $packet = json_decode($content);

        $this->assertSame(200, $httpStatusCode);
        $this->assertTrue($packet->success);

        $data = array_shift($packet->data);
        $this->assertTrue($data->status);
    }

    public function testComAjaxClick2Call()
    {
        $response = $this->get(
            J_URI_ROOT.'index.php?option=com_ajax&plugin=xttwilio&task=click2call&format=json',
            [
                Click2CallHelper::PARAM_PHONE_NUMBER_TO => TEST_USER_PHONE_NUMBER,
            ]
        );
        $httpStatusCode = $response->getStatusCode();
        $content = (string) $response->getBody();

        $this->assertSame(200, $httpStatusCode);
        $this->assertContains('url="'.J_URI_ROOT, $content);
        $this->assertContains(TEST_AGENT_PHONE_NUMBER, $content);
        $this->assertContains('<Say>The call failed or the agent hung up. Goodbye.</Say>', $content);
    }

    public function testComAjaxGetTwiMLResponseScreenForMachine()
    {
        $url = TwiMLResponseHelper::create()->getTwiMLResponseScreenForMachineUrl(J_URI_ROOT);
        $response = $this->get($url);
        $httpStatusCode = $response->getStatusCode();
        $content = (string) $response->getBody();

        $this->assertSame(200, $httpStatusCode);
        $this->assertContains('<Say>Connecting</Say>', $content);
    }

    public function testComAjaxGetTwiMLResponseOutbound()
    {
        $response = $this->get(J_URI_ROOT.
            'index.php?option=com_ajax&plugin=xttwilio&task=getTwiMLResponseOutbound&format=raw'.
            '&'.TwiMLResponseHelper::PARAM_AGENT_PHONE_NUMBER_FROM.'='.TEST_AGENT_PHONE_NUMBER);
        $httpStatusCode = $response->getStatusCode();
        $content = (string) $response->getBody();

        $this->assertSame(200, $httpStatusCode);
        $this->assertContains('url="'.J_URI_ROOT, $content);
        $this->assertContains(TEST_AGENT_PHONE_NUMBER, $content);
        $this->assertContains('<Say>The call failed or the agent hung up. Goodbye.</Say>', $content);
    }

    protected function get($url)
    {
        $client = new HttpMethodsClient(
            HttpClientDiscovery::find(),
            MessageFactoryDiscovery::find()
        );

        return $client->get((string) $url);
    }

    protected function post($url, $fields)
    {
        $client = new HttpMethodsClient(
            HttpClientDiscovery::find(),
            MessageFactoryDiscovery::find()
        );

        $content = http_build_query($fields);

        return $client->post((string) $url, [], $content);
    }
}
