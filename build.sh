#!/bin/sh
set -e

export $(egrep -v '^#' .env | xargs)

docker build \
    -t php-container/php:"${PHP_VERSION}" \
    -t php-container/php:latest \
    --build-arg PHP_BASE_IMAGE_VERSION="${PHP_VERSION}" \
    --build-arg PHP_USER_ID="${PHP_USER_ID}" \
    ./docker/php/
