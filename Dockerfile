FROM yiisoftware/yii2-php:8.1-apache

# Install dependencies for Memcached and the PHP extension
RUN apt-get update && apt-get install -y \
    libmemcached-dev \
    zlib1g-dev \
    libssl-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached

# 2. Enable the extensions (don't "install" xdebug again if it's already there)
RUN docker-php-ext-enable memcached xdebug

# Set the DocumentRoot to /app/web
RUN sed -i 's|/var/www/html|/app/web|g' /etc/apache2/sites-available/000-default.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /app

# Copy the entrypoint script and make it executable
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Ensure permissions for Yii2
RUN mkdir -p runtime web/assets && chmod -R 777 runtime web/assets

# Use the script to start the container
ENTRYPOINT ["entrypoint.sh"]