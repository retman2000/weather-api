FROM nginx:stable-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

WORKDIR /var/www

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

RUN addgroup -g ${GID} --system ci4
RUN adduser -G ci4 --system -D -s /bin/sh -u ${UID} ci4
RUN sed -i "s/user  nginx/user ci4/g" /etc/nginx/nginx.conf

ADD ./docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

#RUN mkdir -p /var/www/html