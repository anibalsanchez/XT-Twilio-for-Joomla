/*
 * @package     XT Twilio for Joomla
 *
 * @author      Extly, CB. <team@extly.com>
 * @copyright   Copyright (c)2007-2018 Extly, CB. All rights reserved.
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 * @see         https://www.extly.com
 */

/* global URLSearchParams, alert, intlTelInputUtils */

document.addEventListener('DOMContentLoaded', function () {
  const postData = (phone) => {
    const data = new URLSearchParams();
    data.append('phone-number-to', phone);

    return fetch('index.php?option=com_ajax&plugin=xttwilio&task=click2call&format=json', {
      body: data,
      method: 'POST',
    });
  };

  const eventHandler = (e, phone, intlTelInputControl) => {
    e.preventDefault();

    if ((!phone.value.length) || (!intlTelInputControl.isValidNumber())) {
      return;
    }

    const intlTelNumber = intlTelInputControl.getNumber(intlTelInputUtils.numberFormat.E164);

    postData(intlTelNumber)
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

  const updateStateHandler = (e, phone, intlTelInputControl) => {
    const state = intlTelInputControl.isValidNumber();

    if (state) {
      phone.classList.remove('invalid');
      phone.classList.add('valid');
    } else {
      phone.classList.remove('valid');
      phone.classList.add('invalid');
    }
  };

  const phone = document.getElementById('xttwilioclick2call-phone');
  const button = document.getElementById('xttwilioclick2call-button');

  // https://github.com/jackocnr/intl-tel-input - International Telephone Input
  const intlTelInputControl = window.intlTelInput(phone, {
    utilsScript: 'media/lib_xttwilio/intl-tel-input/js/utils.js',
  });

  phone.addEventListener("countrychange", phone, e => updateStateHandler(e, phone, intlTelInputControl));
  phone.addEventListener("open:countrydropdown", phone, e => updateStateHandler(e, phone, intlTelInputControl));
  phone.addEventListener("close:countrydropdown", phone, e => updateStateHandler(e, phone, intlTelInputControl));
  phone.addEventListener("focus", phone, e => updateStateHandler(e, phone, intlTelInputControl));
  phone.addEventListener("keyup", e => updateStateHandler(e, phone, intlTelInputControl));
  button.addEventListener('click', e => eventHandler(e, phone, intlTelInputControl));
});
