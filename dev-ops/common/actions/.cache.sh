#!/usr/bin/env bash

I: rm bootstrap/cache/*.php

I: rm src/Core/.phpunit.result.cache
I: find src/Core/src/Resources/storage/* -type f -name '*.php' -delete
