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

document.addEventListener('DOMContentLoaded', function () {
  const postData = (phone) => {
    const data = new URLSearchParams();
    data.append('phone-number-to', phone);

    return fetch('index.php?option=com_ajax&plugin=xttwilio&task=click2call&format=json', {
      body: data,
      method: 'POST',
    });
  };

  const eventHandler = (e, phone) => {
    e.preventDefault();

    if (!phone.value.length) {
      return;
    }

    postData(phone.value)
      .then(response => response.json())
      .then((response) => {
        if (response.success) {
          alert('The call is in progress.');

          return;
        }

        // An exception
        alert(response.message);
        console.log(response);
      });
  };

  const phone = document.getElementById('xttwilioclick2call-phone');
  const button = document.getElementById('xttwilioclick2call-button');

  button.addEventListener('click', e => eventHandler(e, phone));
});
