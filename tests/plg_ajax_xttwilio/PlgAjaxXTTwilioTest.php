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

use PHPUnit\Framework\TestCase;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

class Click2CallHelperTest extends TestCase
{
    public function testComAjaxGetTwiMLResponseScreenForMachine()
    {
        $response = $this->get('http://localhost:8080/index.php?option=com_ajax&plugin=xttwilio&task=getTwiMLResponseScreenForMachine&format=raw');
        $httpStatusCode = $response->getStatusCode();
        $content = (string) $response->getBody();

        $this->assertSame(200, $httpStatusCode);
        $this->assertContains('<Say>Connecting</Say>', $content);
    }

    protected function get($url)
    {
        $factory = MessageFactoryDiscovery::find();
        $request = $factory->createRequest('GET', (string) $url);

        $httpClient = HttpClientDiscovery::find();

        return $httpClient->sendRequest($request);
    }
}
