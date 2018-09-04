FROM php:7.2-apache

RUN apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    git \
    zip \
    unzip \
  && rm -rf /var/lib/apt/lists

# Enable PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Add cake and composer command to system path
#ENV PATH="${PATH}:/var/www/html/audiogene_collection/lib/Cake/Console"
#ENV PATH="${PATH}:/var/www/html/audiogene_collection/app/Vendor/bin"

# COPY apache site.conf file
COPY ./apache/site.conf /etc/apache2/sites-available/000-default.conf

# Copy the source code into /var/www/html/ inside the image
COPY . .

# Set default working directory
WORKDIR ./

# Create tmp directory and make it writable by the web server
#RUN mkdir -p \
#    app/tmp/cache/models \
#    app/tmp/cache/persistent \
#  && chown -R :www-data \
#    app/tmp \
#  && chmod -R 770 \
#    app/tmp

# Enable Apache modules and restart
RUN a2enmod rewrite \
  && service apache2 restart

EXPOSE 80
