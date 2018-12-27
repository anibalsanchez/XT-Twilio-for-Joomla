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

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper as CMSHTMLHelper;

defined('_JEXEC') or die;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

CMSHTMLHelper::stylesheet('lib_xttwilio/intl-tel-input/intlTelInput.min.css', ['version' => 'auto', 'relative' => true]);
CMSHTMLHelper::script('lib_xttwilio/intl-tel-input/intlTelInput.min.js', ['relative' => true], ['defer' => true]);

require ModuleHelper::getLayoutPath('mod_xttwilio_click2call', $params->get('layout', 'default'));
