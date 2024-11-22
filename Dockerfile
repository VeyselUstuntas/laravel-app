FROM php:8.2-apache
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip

RUN a2enmod rewrite 
RUN docker-php-ext-install pdo_mysql

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
WORKDIR /var/www/html
COPY . .
RUN chmod 777 /var/www/html/docker-entrypoint.sh

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN curl -o wait-for-it.sh https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh
RUN chmod +x wait-for-it.sh

ENTRYPOINT ["sh","/var/www/html/docker-entrypoint.sh"]
EXPOSE 80

