# по примеру: https://hub.docker.com/r/phpdocker/phpdocker/dockerfile
FROM php:7.2-fpm

# Locales
RUN apt-get update \
	&& apt-get install -y locales

RUN dpkg-reconfigure locales \
	&& locale-gen C.UTF-8 \
	&& /usr/sbin/update-locale LANG=C.UTF-8

RUN echo 'ru_RU.UTF-8 UTF-8' >> /etc/locale.gen \
	&& locale-gen

ENV LC_ALL C.UTF-8
ENV LANG ru_RU.UTF-8
ENV LANGUAGE ru_RU.UTF-8

# Common
#RUN apt-get update \
#	&& apt-get install -y \
#		openssl \
#		git \
#		gnupg2

# PHP
# intl
#RUN apt-get update \
#	&& apt-get install -y libicu-dev \
#	&& docker-php-ext-configure intl \
#	&& docker-php-ext-install -j$(nproc) intl

# xml
#RUN apt-get update \
#	&& apt-get install -y \
#	libxml2-dev \
#	libxslt-dev \
#	&& docker-php-ext-install -j$(nproc) \
#		dom \
#		xmlrpc \
#		xsl

# images
#RUN apt-get update \
#	&& apt-get install -y \
#	libfreetype6-dev \
#	libjpeg62-turbo-dev \
#	libpng-dev \
#	libgd-dev \
#	&& docker-php-ext-configure gd \
#	&& docker-php-ext-install -j$(nproc) \
#		gd \
#		exif

# imagick
#RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
#RUN printf "\n" | pecl install imagick
#RUN docker-php-ext-enable imagick

# database
RUN docker-php-ext-install -j$(nproc) \
	mysqli \
	pdo \
	pdo_mysql

# strings
#RUN apt-get update \
#    && apt-get install -y libonig-dev \
#    && docker-php-ext-install -j$(nproc) \
#	    gettext \
#	    mbstring

# math
#RUN apt-get update \
#	&& apt-get install -y libgmp-dev \
#	&& ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h \
#	&& docker-php-ext-install -j$(nproc) \
#		gmp \
#		bcmath

# compression
#RUN apt-get update \
#	&& apt-get install -y \
#	libbz2-dev \
#	zlib1g-dev \
#	libzip-dev \
#    unzip \
#    p7zip \
#	&& docker-php-ext-install -j$(nproc) \
#		zip \
#		bz2

# ftp
#RUN apt-get update \
#	&& apt-get install -y \
#	libssl-dev \
#	&& docker-php-ext-install -j$(nproc) \
#		ftp

# ssh2
#RUN apt-get update \
#	&& apt-get install -y \
#	libssh2-1-dev

# memcached
#RUN apt-get update \
#	&& apt-get install -y \
#	libmemcached-dev \
#	libmemcached11

# others
#RUN docker-php-ext-install -j$(nproc) \
#	soap \
#	sockets \
#	calendar \
#	sysvmsg \
#	sysvsem \
#	sysvshm

# Install XDebug, but not enable by default. Enable using:
# * php -d$XDEBUG_EXT vendor/bin/phpunit
# * php_xdebug vendor/bin/phpunit
#RUN pecl install xdebug-2.8.0
#ENV XDEBUG_EXT zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20190902/xdebug.so
#RUN alias php_xdebug="php -d$XDEBUG_EXT vendor/bin/phpunit"

# Install composer and put binary into $PATH
#RUN curl -sS https://getcomposer.org/installer | php \
#	&& mv composer.phar /usr/local/bin/ \
#	&& ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Install PHP Code sniffer
#RUN curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar \
#	&& chmod 755 phpcs.phar \
#	&& mv phpcs.phar /usr/local/bin/ \
#	&& ln -s /usr/local/bin/phpcs.phar /usr/local/bin/phpcs \
#	&& curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar \
#	&& chmod 755 phpcbf.phar \
#	&& mv phpcbf.phar /usr/local/bin/ \
#	&& ln -s /usr/local/bin/phpcbf.phar /usr/local/bin/phpcbf

# Install PHPUnit
#RUN curl -OL https://phar.phpunit.de/phpunit.phar \
#	&& chmod 755 phpunit.phar \
#	&& mv phpunit.phar /usr/local/bin/ \
#	&& ln -s /usr/local/bin/phpunit.phar /usr/local/bin/phpunit
#
#ADD php.ini /usr/local/etc/php/conf.d/docker-php.ini

## NodeJS, NPM
# Install NodeJS
#RUN #curl -sL https://deb.nodesource.com/setup_12.x | bash - \
##    && apt-get install -y nodejs
#RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
#    && apt-get install -y nodejs

# Install Gulp globally
#RUN npm install -g gulp-cli

# Install Bower globally
#RUN npm install -g bower

# Clean
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/*

WORKDIR /app
