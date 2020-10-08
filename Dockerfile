FROM composer:1.9.3

# Copy entire application to app directory in the container
WORKDIR /app
COPY . .

# Install Packages
RUN composer install --ignore-platform-reqs

RUN docker-php-ext-install pdo_mysql

# Migrate Database and Execute Application
CMD php artisan migrate --force & php artisan serve --host=0.0.0.0 --port=80

EXPOSE 80
