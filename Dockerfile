FROM ubuntu
ENV TZ=Asia/Dubai

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
#empty comment
RUN apt update && apt -y upgrade
RUN apt -y install tzdata


RUN apt-get -y install software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt-get -y install apache2 
RUN apt -y install php8.0
RUN apt -y install php8.0-common php8.0-fpm php8.0-mysql php8.0-gmp php8.0-xml php8.0-xmlrpc php8.0-curl php8.0-mbstring php8.0-gd php8.0-dev php8.0-imap php8.0-opcache php8.0-readline php8.0-soap php8.0-zip php8.0-intl php8.0-cli libapache2-mod-php8.0 php-curl 
RUN apt -y install composer 

WORKDIR /var/www/html

RUN rm index.html
COPY Seoland/ /var/www/html/

RUN composer update
RUN composer install
RUN chmod -R 777 .

COPY 000-default.conf /etc/apache2/sites-available

RUN a2enmod php8.0 rewrite
RUN service apache2 restart
EXPOSE 80
CMD apachectl -D FOREGROUND
