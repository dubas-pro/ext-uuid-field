FROM devilbox/php-fpm:8.0-work

RUN set -ex; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        libzmq3-dev; \
    \
# Install php-zmq
    cd /usr; \
    curl -fSL https://github.com/zeromq/php-zmq/archive/ee5fbc693f07b2d6f0d9fd748f131be82310f386.tar.gz -o php-zmq.tar.gz; \
    tar -zxf php-zmq.tar.gz; \
    cd php-zmq*; \
    phpize && ./configure; \
    make; \
    make install; \
    cd .. && rm -rf php-zmq*; \
# END: Install php-zmq
    docker-php-ext-enable zmq;

COPY --chmod=0755 ./docker-*.sh  /usr/local/bin/
