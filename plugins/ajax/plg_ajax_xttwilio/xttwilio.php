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

use Joomla\CMS\Factory as CMSFactory;
use Joomla\CMS\Plugin\CMSPlugin;
use XTTwilio\Infrastructure\Service\Twilio\Click2CallHelper;
use XTTwilio\Infrastructure\Service\Twilio\SMSHelper;
use XTTwilio\Infrastructure\Service\Twilio\TwiMLResponseHelper;

/**
 * XTTwilio plugin.
 *
 * @since    1.0
 */
class PlgAjaxXTTwilio extends CMSPlugin
{
    protected $accountSid;
    protected $authToken;
    protected $phoneNumber;

    /**
     * onAjaxXTTwilio.
     */
    public function onAjaxXTTwilio()
    {
        if (!$this->initialize()) {
            return false;
        }

        $input = CMSFactory::getApplication()->input;

        $task = $input->get('task');

        switch ($task) {
            case 'sendsms':
                return $this->onAjaxSendSMS();

                break;
            case 'click2call':
            return $this->onAjaxClick2Call();

                break;
            case 'getTwiMLResponseOutbound':
                return $this->onGetTwiMLResponseOutbound();

                break;
            case 'getTwiMLResponseScreenForMachine':
                return $this->getTwiMLResponseScreenForMachine();

                break;
        }
    }

    protected function initialize()
    {
        $this->accountSid = $this->params->get('account_sid');
        $this->authToken = $this->params->get('auth_token');
        $this->phoneNumber = $this->params->get('phone_number');

        if (empty($this->accountSid)) {
            return false;
        }

        if (empty($this->authToken)) {
            return false;
        }

        if (empty($this->phoneNumber)) {
            return false;
        }

        require_once JPATH_ROOT.'/libraries/xttwilio/vendor/autoload.php';

        return true;
    }

    /**
     * onAjaxSendSMS.
     */
    protected function onAjaxSendSMS()
    {
        if (empty($phoneNumberFrom)) {
            return false;
        }

        if (empty($message)) {
            return false;
        }

        $smsHelper = SMSHelper::create($this->accountSid, $this->authToken, $this->phoneNumber);

        return $smsHelper->sendSms($phoneNumberFrom, $message);
    }

    /**
     * onAjaxClick2Call.
     */
    protected function onAjaxClick2Call()
    {
        if (empty($phoneNumberFrom)) {
            return false;
        }

        if (empty($message)) {
            return false;
        }

        $smsHelper = Click2CallHelper::create($this->accountSid, $this->authToken, $this->phoneNumber);

        return $smsHelper->call($phoneNumberTo);
    }

    /**
     * onGetTwiMLResponseOutbound.
     */
    protected function onGetTwiMLResponseOutbound()
    {
        $screenForMachineResponseUrl = 'http...';
        $agentPhoneNumber = 999;

        return TwiMLResponseHelper::create()->getOutboundResponse($screenForMachineResponseUrl, $agentPhoneNumber);
    }

    /**
     * getTwiMLResponseScreenForMachine.
     */
    protected function getTwiMLResponseScreenForMachine()
    {
        return TwiMLResponseHelper::create()->getScreenForMachineResponse();
    }
}
