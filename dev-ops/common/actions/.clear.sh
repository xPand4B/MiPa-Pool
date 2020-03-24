#!/usr/bin/env bash

I: rm -rf public/storage

I: rm -rf public/css
I: rm -rf public/fonts
I: rm -rf public/js
I: rm -rf public/sprites
I: rm -rf public/svgs
I: rm -rf public/webfonts
I: rm public/*.js

I: rm storage/oauth/*.key
I: rm storage/logs/*.log

I: rm .phpunit.result.cache
