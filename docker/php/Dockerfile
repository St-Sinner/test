ARG PHP_BASE_IMAGE_VERSION
FROM yiisoftware/yii2-php:${PHP_BASE_IMAGE_VERSION}

# Install modules
RUN apt-get update && apt-get install -y

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

ARG USER_ID=1000
RUN usermod -o -u ${USER_ID} -g www-data www-data

WORKDIR /app
ADD . /app

RUN chown -R www-data:www-data /app
