#!/bin/sh

npx babel modules/site/mod_xttwilio_sms/media/js/mod_xttwilio_sms.js --presets=es2015 | \
  uglifyjs --compress --mangle > modules/site/mod_xttwilio_sms/media/js/mod_xttwilio_sms.min.js

npx babel modules/site/mod_xttwilio_click2call/media/js/mod_xttwilio_click2call.js --presets=es2015 | \
  uglifyjs --compress --mangle > modules/site/mod_xttwilio_click2call/media/js/mod_xttwilio_click2call.min.js

## npm ci
npm run build
