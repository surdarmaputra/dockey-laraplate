FROM nginx:latest

RUN adduser --disabled-password --disabled-login --ingroup root --gecos "" kromatin
ADD  ./dockey.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www