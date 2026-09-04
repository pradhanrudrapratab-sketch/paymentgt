FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libcurl4-openssl-dev \
        pkg-config \
    && docker-php-ext-install curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY public ./public

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
