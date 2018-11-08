<?php
/**
 * @author     Extly, CB <team@extly.com>
 * @copyright  Copyright (c)2007-2018 Extly, CB All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 *
 * @see       https://www.extly.com
 */
defined('_JEXEC') or die;

$moduleclass_sfx .= ' '.'mod_xttwilio_sms'.$module->id;

use Joomla\CMS\HTML\HTMLHelper as CMSHTMLHelper;

CMSHTMLHelper::script('mod_xttwilio_sms/mod_xttwilio_sms.min.js', ['relative' => true], ['defer' => true]);

?>
<div class="xttwilio-sms<?php echo $moduleclass_sfx; ?>">
  <form action="<?php echo JRoute::_('index.php'); ?>" method="post">
    <div id="form-xttwiliosms-message" class="control-group">
      <div class="controls">
        <label for="xttwiliosms-message">
            <?php echo JText::_('MOD_XTTWILIO_SMS_MESSAGE_LABEL'); ?></label>
        <div class="controls">
          <textarea id="xttwiliosms-message" name="message" placeholder="<?php
            echo JText::_('MOD_XTTWILIO_SMS_MESSAGE_PLACEHOLDER'); ?>"></textarea>
        </div>
      </div>

      <div class="controls">
        <label for="xttwiliosms-phone">
            <?php echo JText::_('MOD_XTTWILIO_SMS_PHONE_LABEL'); ?></label>
        <div class="controls">
          <input type="tel" id="xttwiliosms-phone" name="phone" placeholder="<?php
            echo JText::_('MOD_XTTWILIO_SMS_PHONE_PLACEHOLDER'); ?>" pattern="\+?[0-9]+" required />
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <button id="xttwiliosms-button" type="submit" class="btn">
            <?php echo JText::_('MOD_XTTWILIO_SMS_SEND_BUTTON'); ?></button>
        </div>
      </div>

      <input type="hidden" name="option" value="com_ajax" />
      <input type="hidden" name="plugin" value="xttwilio" />
      <input type="hidden" name="format" value="raw" />
      <input type="hidden" name="task" value="sendsms" />
  </form>
</div>
