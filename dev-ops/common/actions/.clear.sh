#!/usr/bin/env bash

I: rm -rf public/storage

I: rm public/*.js

I: rm storage/oauth/*.key
I: rm storage/logs/*.log

I: rm .phpunit.result.cache
