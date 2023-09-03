#!/bin/bash

set -eu

/usr/local/bin/php /var/www/default/site/websocket.php

exec "$@"
