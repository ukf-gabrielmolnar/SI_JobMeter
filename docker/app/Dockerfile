FROM php:8.1-fpm-alpine

#compose setup
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

RUN adduser test -D -u 1000

#chown www-data to var/www/html
RUN chown -R www-data:www-data /var/www/html

#copy files
COPY . /var/www/html

#change workdir
WORKDIR /var/www/html

# add executable permission to startup sh and permissions
RUN chmod +x ./docker/app/startup.sh
RUN chmod -R 777 ./docker/app/startup.sh


# login before composer install
USER www-data

# install composer packages

# run startup.sh

#ENTRYPOINT ["sh", "./docker/app/startup.sh"]

