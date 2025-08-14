FROM caddy:2.10.0 AS base

# document root is /var/www/html
WORKDIR /var/www/html

COPY Caddyfile /etc/caddy/Caddyfile
# RUN chown -R caddy:caddy /var/www/html
# USER caddy



#####################################################

FROM composer:2.8.10 AS builder

WORKDIR /api
COPY composer.json .
COPY composer.lock .

RUN composer install
COPY . .
RUN composer dumpautoload --optimize

#####################################################

FROM base AS final

COPY --from=builder /api /var/www/html

