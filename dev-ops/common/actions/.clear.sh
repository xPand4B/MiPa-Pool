#!/usr/bin/env bash

I: rm -rf public/css/
I: rm -rf public/fonts
I: rm -rf public/js
I: rm -rf public/sprites
I: rm -rf public/storage
I: rm -rf public/svgs
I: rm -rf public/webfonts
I: rm public/*.js

I: rm -rf src/vendor

I: rm src/Core/src/Resources/storage/logs/*.log
I: rm src/Core/src/Resources/storage/oauth/*.key

I: rm -rf src/Frontend/Resources/app/node_modules
