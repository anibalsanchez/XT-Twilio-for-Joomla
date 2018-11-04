document.addEventListener('DOMContentLoaded', function() {
  const postData = (phone, message) =>
    fetch(
      'index.php?option=com_ajax&plugin=xttwilio&task=sendsms&format=json',
      {
        body: JSON.stringify({
          'phone-number-from': phone,
          message: message,
        }),
        method: 'POST',
        headers: {
          'content-type': 'application/json',
        },
      }
    );

  const eventHandler = (message, phone) => {
    if (!message.value.length) {
      return;
    }

    if (!phone.value.length) {
      return;
    }

    postData(phone, message)
      .then(response => response.json())
      .then(response => console.log(response));
  }

  const message = document.getElementById('xttwiliosms-message');
  const phone = document.getElementById('xttwiliosms-phone');
  const button = document.getElementById('xttwiliosms-button');

  button.addEventListener('click', () => eventHandler(message, phone));
});
