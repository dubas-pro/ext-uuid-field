ARG PHP_VERSION

FROM devilbox/php-fpm:${PHP_VERSION}

USER devilbox
RUN ["/bin/bash", "-c", "/usr/local/bin/composer global require dubas/espo-console"]

USER root
RUN set -ex; \
    \
    ln --symbolic /home/devilbox/.composer/vendor/bin/espo /usr/local/bin/espo; \
    ln --symbolic /opt/nvm/versions/node/*/bin/pnpm /usr/local/bin/pnpm;

COPY --chmod=0755 common/docker-*.sh  /usr/local/bin/
