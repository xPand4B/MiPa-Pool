#!/usr/bin/env bash

I: rm src/.phpunit.result.cache

I: rm -r src/Core/Resources/storage/framework/cache/data/*
I: rm -r src/Core/Resources/storage/framework/views/*.php
I: rm -r src/Core/Resources/storage/framework/views/*.php
I: rm -r src/Core/Resources/storage/logs/*.log

I: rm -r src/Core/System/Bootstrap/cache/*.php
