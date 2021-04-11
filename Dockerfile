FROM php:7.4-alpine3.13

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

CMD composer install \
    && cp .env.example .env \
    && php artisan key:generate \
    && touch /app/database/database.sqlite \
    && php artisan migrate \
    && php artisan serve --host=0.0.0.0