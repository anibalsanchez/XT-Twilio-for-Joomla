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

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Twilio\Rest\Client as TwilioRest;

/**
 * XTTwilio plugin.
 *
 * @since    1.0
 */
class PlgAjaxXTTwilio extends CMSPlugin
{
    const CLICK2CALL_RESPONSE_OUTBOUND = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<Response>
    <Dial>
        <Number url="onClic2CallScreenForMachine">
            PHONE_NUMBER_FROM
        </Number>
    </Dial>
    <Say>The call failed or the agent hung up. Goodbye.</Say>
</Response>
XML;

    const CLICK2CALL_RESPONSE_SCREEN_FOR_MACHINE = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<Response>
    <Say>Connecting</Say>
</Response>
XML;
    protected $accountSid;
    protected $authToken;
    protected $phoneNumberTo;

    /**
     * onAjaxSendSMS.
     */
    public function onAjaxSendSMS()
    {
        if (!$this->initialize()) {
            return false;
        }

        $response = $this->sendSMS($phoneNumberFrom, $message);

        return json_encode($response);
    }

    /**
     * onAjaxClick2Call.
     */
    public function onAjaxClick2Call()
    {
        if (!$this->initialize()) {
            return false;
        }

        $response = $this->click2Call($phoneNumberFrom);

        return json_encode($response);
    }

    public function onClic2CallOutbound()
    {
        return self::CLICK2CALL_RESPONSE_OUTBOUND;
    }

    public function onClic2CallScreenForMachine()
    {
        return self::CLICK2CALL_RESPONSE_SCREEN_FOR_MACHINE;
    }

    protected function initialize()
    {
        $this->accountSid = $this->params->get('account_sid');
        $this->authToken = $this->params->get('auth_token');
        $this->phoneNumberTo = $this->params->get('phone_number');

        if (empty($this->accountSid)) {
            return false;
        }

        if (empty($this->authToken)) {
            return false;
        }

        if (empty($this->phoneNumberTo)) {
            return false;
        }

        require_once JPATH_ROOT.'/libraries/xttwilio/vendor/autoload.php';

        return true;
    }

    protected function sendSMS($phoneNumberFrom, $message)
    {
        if (empty($phoneNumberFrom)) {
            return false;
        }

        if (empty($message)) {
            return false;
        }

        $client = new TwilioRest($this->accountSid, $this->authToken);
        $response = $client->messages->create($this->phoneNumberTo, ['from' => $phoneNumberFrom, 'body' => $message]);

        return $response;
    }

    protected function click2Call($phoneNumberFrom)
    {
        if (empty($phoneNumberFrom)) {
            return false;
        }

        if (empty($message)) {
            return false;
        }

        $client = new TwilioRest($this->accountSid, $this->authToken);
        $response = $client->calls->create($phoneNumberTo, $phoneNumberFrom);

        return $response;
    }
}
