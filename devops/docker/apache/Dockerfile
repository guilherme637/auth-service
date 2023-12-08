FROM ubuntu/apache2:2.4-20.04_edge
ENV TZ America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
WORKDIR /var/www/html

RUN a2enmod rewrite headers mpm_event actions proxy proxy_fcgi setenvif info

