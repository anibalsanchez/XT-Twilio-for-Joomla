#!/bin/sh

npx babel modules/site/mod_xttwilio_sms/media/js/mod_xttwilio_sms.js --presets=es2015 | \
  uglifyjs --compress --mangle > modules/site/mod_xttwilio_sms/media/js/mod_xttwilio_sms.min.js

## npm ci
npm run build
