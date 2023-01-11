# Use an official PHP runtime as the base image
FROM php:8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libapache2-mod-php \
    apache2

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable the Apache mod_rewrite module
RUN a2enmod rewrite

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

# Copy the Apache configuration file
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Expose the port for the web server
EXPOSE 80

# Start the Apache web server
CMD ["apache2ctl", "-D", "FOREGROUND"]
