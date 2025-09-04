FROM php:8.4-fpm-alpine AS base

# smbclient for alpine
RUN apk update && \
    apk add samba-client && \
    apk cache clean
#####################################################

FROM composer:2.8.10 AS builder

WORKDIR /api
COPY ./app/composer.json .
COPY ./app/composer.lock .

RUN composer install
COPY ./app .
RUN composer dumpautoload --optimize

#####################################################

FROM base AS final

# ist das kopieren in den WEBSERVER CONTAINER UEBERHAUPT NOTWENDIG?
# es sind ja alles php Dateien, die nur im php-fpm Container liegen muessen
COPY --from=builder /api /var/www/html

