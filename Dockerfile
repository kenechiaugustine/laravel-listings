FROM php:8.1-apache

# Copy the application code into the container
COPY . /var/www/html/

# Update the system and install necessary dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN cd /var/www/html && composer install

# run migration and generate key
RUN if [ -z "$APP_KEY" ]; then php /var/www/html/artisan key:generate; fi
RUN php /var/www/html/artisan migrate --force

# Make sure the web server user has the correct permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 and start the Apache web server
EXPOSE 80
CMD ["apache2-foreground"]
