#!/usr/bin/env bash
# DESCRIPTION: Build the frontend.

I: rm public/*.js
I: rm public/*.js.map

INCLUDE: ./../../common/actions/.npm-run-dev.sh
