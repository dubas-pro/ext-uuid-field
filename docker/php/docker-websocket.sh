#!/bin/bash

set -eu

/usr/local/bin/php /shared/httpd/websocket.php

exec "$@"
