#reference from my infs3208 a1
FROM ubuntu:18.04
MAINTAINER Chi Jian s4614011@stuent.uq.edu.au

ENV PHPVER=7.4
ENV TZ=Asia/Shanghai

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get -y install software-properties-common \
    && add-apt-repository ppa:ondrej/php  \
    && apt-get -y install nginx php$PHPVER-fpm \
    && apt-get -y install php7.*-mysqli\
    && mkdir -p /var/run/php

EXPOSE 80

COPY ./src/nginx.ini /etc/nginx/sites-available/default
COPY ./src/ /var/www/html/



ENTRYPOINT service php$PHPVER-fpm start && nginx -g "daemon off;"












