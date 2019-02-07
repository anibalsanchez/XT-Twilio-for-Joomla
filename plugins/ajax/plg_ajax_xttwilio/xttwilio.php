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

defined('_JEXEC') or die;

use Joomla\CMS\Factory as CMSFactory;
use Joomla\CMS\Input\Input as CMSInput;
use Joomla\CMS\Plugin\CMSPlugin;
use XTTwilio\Infrastructure\Service\Twilio\Click2CallHelper;
use XTTwilio\Infrastructure\Service\Twilio\SMSHelper;
use XTTwilio\Infrastructure\Service\Twilio\TaskFactory;
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
    protected $agentPhoneNumber;

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
        }
    }

    protected function initialize()
    {
        $this->accountSid = $this->params->get('account_sid');
        $this->authToken = $this->params->get('auth_token');
        $this->phoneNumber = $this->params->get('phone_number');
        $this->agentPhoneNumber = $this->params->get('agent_phone_number');

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
        $input = new CMSInput();

        $message = $input->getString(SMSHelper::PARAM_MESSAGE);
        $firstName = $input->getCmd(SMSHelper::PARAM_FIRST_NAME);
        $phoneNumberFrom = $input->getCmd(SMSHelper::PARAM_PHONE_NUMBER_FROM);

        if (empty($message)) {
            throw new Exception('Error: Invalid Phone Number Message');
        }

        if (empty($firstName)) {
            throw new Exception('Error: Invalid First Name');
        }

        if (empty($phoneNumberFrom)) {
            throw new Exception('Error: Invalid Phone Number From');
        }

        try {
            $task = $this->defineNewTask($phoneNumberFrom, $message, $firstName);
            $smsMessage = $task->getSmsMessage();

            $result = SMSHelper::create($this->accountSid, $this->authToken, $this->phoneNumber)
                ->sendSms($smsMessage, $task->getE164PhoneNumber());
        } catch (Exception $e) {
            throw new Exception('Error: '.$e->getMessage());
        }

        return $result->sid;
    }

    /**
     * onAjaxClick2Call.
     */
    protected function onAjaxClick2Call()
    {
        $input = new CMSInput();
        $phoneNumberTo = $input->get(Click2CallHelper::PARAM_PHONE_NUMBER_TO);

        if (empty($phoneNumberTo)) {
            throw new Exception('Error: Invalid Phone Number To');
        }

        try {
            $task = $this->defineNewTask($phoneNumberTo, 'Please, call me.');
            $e164PhoneNumber = $task->getE164PhoneNumber();

            $result = Click2CallHelper::create($this->accountSid, $this->authToken, $this->phoneNumber, JUri::root())
                ->call($e164PhoneNumber);
        } catch (Exception $e) {
            throw new Exception('Error: '.$e->getMessage());
        }

        return $result->sid;
    }

    protected function defineNewTask($phoneNumberFrom, $message = null, $firstName = null)
    {
        return TaskFactory::create($this->accountSid, $this->authToken, $this->params->get('workspace_sid'), $this->params->get('workflow_sid'))
            ->defineNewTask($phoneNumberFrom, $message, $firstName);
    }

    /**
     * onGetTwiMLResponseOutbound.
     */
    protected function onGetTwiMLResponseOutbound()
    {
        return TwiMLResponseHelper::create()->getOutboundResponse($this->agentPhoneNumber);
    }
}
