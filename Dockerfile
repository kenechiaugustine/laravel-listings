# Use an official PHP runtime as the base image
FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a working directory
RUN mkdir /var/www/app

# Set the working directory
WORKDIR /var/www/app

# Copy the application code
COPY . .

# Install dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Make storage and bootstrap cache directories writeable by the web server user
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# Expose the port for the web server
EXPOSE 9000

# Start the web server
CMD ["php-fpm"]
