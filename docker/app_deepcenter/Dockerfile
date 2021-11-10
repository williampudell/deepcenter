FROM ubuntu:focal

WORKDIR /var/www/html

RUN apt-get update
RUN apt-get install -y software-properties-common apt-utils
RUN apt-get install -y iputils-ping redis-tools curl gnupg2 ca-certificates lsb-release apt-transport-https
RUN apt-get install -y cron zip unzip
RUN apt-get install -y supervisor
RUN add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y apache2 libapache2-mod-php7.4 php7.4-fpm php7.4 \
    php7.4-bcmath php7.4-cli php7.4-curl php7.4-dev php7.4-gd \
    php7.4-imap php7.4-intl php7.4-mbstring php7.4-mysql \
    php7.4-pgsql php7.4-pspell php7.4-xml php7.4-xmlrpc \
    php7.4-zip php-apcu php-memcached php-pear php-redis

RUN a2enmod rewrite actions alias proxy_fcgi setenvif

RUN a2dissite 000-default

RUN a2enconf php7.4-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install nodejs -y

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh | bash

RUN apt-get update && apt-get install -y vim nano gpg-agent \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

RUN /etc/init.d/cron start

RUN php-fpm7.4 -t

RUN /etc/init.d/php7.4-fpm start

RUN update-alternatives --set php /usr/bin/php7.4
RUN update-alternatives --set phar /usr/bin/phar7.4
RUN update-alternatives --set phar.phar /usr/bin/phar.phar7.4
RUN update-alternatives --set phpize /usr/bin/phpize7.4
RUN update-alternatives --set php-config /usr/bin/php-config7.4

COPY ./hosts /etc/hosts

COPY ./deepcenter.conf /etc/apache2/sites-available/deepcenter.conf

COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN a2ensite deepcenter.conf

RUN /usr/sbin/apache2ctl restart

EXPOSE 80 443

CMD ["/usr/bin/supervisord"]