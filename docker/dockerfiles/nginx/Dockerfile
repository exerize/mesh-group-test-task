#FROM nginx:1.19.6-alpine
#ARG USER_GID=1000
#ARG USER_UID=1000
#
#RUN apk update && \
#    apk add shadow && \
#    groupmod -g ${USER_GID} www-data && \
#    apk del shadow && \
#    set -x ; \
#    addgroup -g ${USER_GID} -S www-data ; \
#    adduser -u ${USER_UID} -D -S -G www-data www-data && \
#    sed -i -- "s/user  nginx;/user www-data;/" /etc/nginx/nginx.conf && \
#    rm -f /etc/nginx/conf.d/* && \
#    mkdir -p /var/www/app && \
#    chown www-data:www-data /var/www/app && \
#    rm -Rf ./* /etc/nginx/conf.d/nginx.conf
#
#WORKDIR /var/www/public

FROM nginx:1.19.6-alpine
ARG USER_GID=1000
ARG USER_UID=1000

RUN apk update && \
    apk add shadow && \
    groupmod -g ${USER_GID} www-data && \
    apk del shadow && \
    set -x ; \
    addgroup -g ${USER_GID} -S www-data ; \
    adduser -u ${USER_UID} -D -S -G www-data www-data && \
    sed -i -- "s/user  nginx;/user www-data;/" /etc/nginx/nginx.conf

WORKDIR /var/www/public

RUN rm -f /etc/nginx/conf.d/* && \
    mkdir -p /var/www/app \
  && chown www-data:www-data /var/www/app && \
     rm -Rf ./* /etc/nginx/conf.d/nginx.conf
