FROM caddy:2.10.2-alpine AS base

WORKDIR /var/www/html
COPY ./service_caddy/Caddyfile /etc/caddy/Caddyfile

#############################################################################

FROM composer:2.8.10 AS builder

WORKDIR /api
COPY ./app/composer.json .
COPY ./app/composer.lock .
RUN composer install
COPY ./app .
RUN composer dumpautoload --optimize

############################################################################

FROM base AS final

COPY --from=builder /api /var/www/html



