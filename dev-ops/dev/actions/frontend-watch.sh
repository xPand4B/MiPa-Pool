#!/usr/bin/env bash
# DESCRIPTION: Start the js watcher.

I: rm public/*.js
I: rm public/*.js.map

INCLUDE: ./../../common/actions/.npm-run-watch.sh
