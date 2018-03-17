FROM php:apache
MAINTAINER Jessica Smith <jess@mintopia.net>

COPY src/ /var/www/html/
RUN \
	docker-php-ext-install -j$(nproc) zlib