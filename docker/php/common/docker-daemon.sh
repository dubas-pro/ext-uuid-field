#!/bin/bash

set -eu

/usr/local/bin/php /var/www/default/site/daemon.php

exec "$@"
