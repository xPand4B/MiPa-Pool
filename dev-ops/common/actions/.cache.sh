#!/usr/bin/env bash

I: rm bootstrap/cache/*.php
I: find storage/* -type f -name '*.php' -delete
