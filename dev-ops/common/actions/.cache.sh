#!/usr/bin/env bash

I: rm src/Core/System/Bootstrap/cache/*.php

I: rm src/.phpunit.result.cache
I: find src/Core/src/Resources/storage/* -type f -name '*.php' -delete
