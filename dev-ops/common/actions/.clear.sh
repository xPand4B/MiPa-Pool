#!/usr/bin/env bash

# General
I: rm public/css/app.css
I: rm public/js

I: rm -rf public/fonts
I: rm -rf public/sprites
I: rm -rf public/storage
I: rm -rf public/svgs
I: rm -rf public/webfonts

I: rm public/*.js
I: rm public/*.js.map

I: rm -rf src/vendor

# Core
I: rm src/Core/src/Resources/storage/logs/*.log

#Frontend
I: rm -rf src/Frontend/Resources/app/node_modules
