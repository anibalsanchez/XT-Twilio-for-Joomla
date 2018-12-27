<?php
/**
 * @author     Extly, CB <team@extly.com>
 * @copyright  Copyright (c)2007-2018 Extly, CB All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 *
 * @see       https://www.extly.com
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory as CMSFactory;
use Joomla\CMS\HTML\HTMLHelper as CMSHTMLHelper;

$moduleclass_sfx .= ' '.'mod_xttwilio_click2call'.$module->id;

CMSHTMLHelper::script('mod_xttwilio_click2call/mod_xttwilio_click2call.min.js', ['relative' => true], ['defer' => true]);
CMSFactory::getDocument()->addStyleDeclaration('#xttwilioclick2call-phone { height: 28px; }');

?>
<div class="xttwilio-click2call<?php echo $moduleclass_sfx; ?>">
  <form action="<?php echo JRoute::_('index.php'); ?>" method="post">

    <div class="control-group">
      <label for="xttwilioclick2call-phone">
            <?php echo JText::_('MOD_XTTWILIO_CLICK2CALL_PHONE_LABEL'); ?></label>
      <div class="controls">
        <input type="tel" id="xttwilioclick2call-phone" name="phone" placeholder="<?php
            echo JText::_('MOD_XTTWILIO_CLICK2CALL_PHONE_PLACEHOLDER'); ?>" required class="input-xlarge"/>
      </div>
    </div>

    <div class="control-group">
      <div class="controls">
        <button id="xttwilioclick2call-button" type="submit" class="btn">
          <?php echo JText::_('MOD_XTTWILIO_CLICK2CALL_SEND_BUTTON'); ?></button>
      </div>
    </div>

    <input type="hidden" name="option" value="com_ajax" />
    <input type="hidden" name="plugin" value="xttwilio" />
    <input type="hidden" name="format" value="raw" />
    <input type="hidden" name="task" value="click2call" />
  </form>
</div>
