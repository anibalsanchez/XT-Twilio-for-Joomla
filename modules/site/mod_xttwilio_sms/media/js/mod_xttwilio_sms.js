/*
 * @package     XT Twilio for Joomla
 *
 * @author      Extly, CB. <team@extly.com>
 * @copyright   Copyright (c)2007-2018 Extly, CB. All rights reserved.
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 * @see         https://www.extly.com
 */

/* global URLSearchParams, alert */

document.addEventListener('DOMContentLoaded', function() {
  const postData = (phone, message) => {
    const data = new URLSearchParams();
    data.append('phone-number-from', phone);
    data.append('message', message);

    return fetch('index.php?option=com_ajax&plugin=xttwilio&task=sendsms&format=json', {
      body: data,
      method: 'POST',
    });
  };

  const eventHandler = (e, message, phone) => {
    e.preventDefault();

    if (!message.value.length) {
      return;
    }

    if (!phone.value.length) {
      return;
    }

    postData(phone.value, message.value)
      .then(response => response.json())
      .then((response) => {
        if (response.success) {
          alert('Message sent.');

          return;
        }

        // An exception
        alert(response.message);
        console.log(response);
      });
  };

  const message = document.getElementById('xttwiliosms-message');
  const phone = document.getElementById('xttwiliosms-phone');
  const button = document.getElementById('xttwiliosms-button');

  button.addEventListener('click', e => eventHandler(e, message, phone));
});
