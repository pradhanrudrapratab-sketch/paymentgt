FROM php:8.3-cli

RUN docker-php-ext-install curl

WORKDIR /app

COPY public ./public

CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
