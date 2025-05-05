ARG PHP_VERSION="8.4.6"
ARG CADDY_VERSION="2.10.0"
ARG PHP_EXTENSION_INSTALLER_VERSION="2.7.31"

FROM mlocati/php-extension-installer:${PHP_EXTENSION_INSTALLER_VERSION} AS php-extension-installer

FROM caddy:${CADDY_VERSION} AS caddy

FROM php:${PHP_VERSION}-fpm AS base

COPY --from=caddy --chmod=0755 /usr/bin/caddy /usr/local/bin/

COPY --from=php-extension-installer --chmod=0755 /usr/bin/install-php-extensions /usr/local/bin/

RUN set -e; \
    apt-get update; \
    apt-get install --no-install-recommends -y \
    ssh \
	acl \
	file \
	gettext \
    libfcgi-bin \
	git; \
	rm -rf /var/lib/apt/lists/*;

RUN set -eux; \
    install-php-extensions \
    @composer \
    pdo_pgsql \
    apcu \
    intl \
    opcache;

WORKDIR /srv/app

EXPOSE 8443

EXPOSE 9000

RUN set -eux; \
    install-php-extensions \
    xdebug;

ENV XDEBUG_MODE "off"