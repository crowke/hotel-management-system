#!/usr/bin/env bash

cd `dirname $0`
DIR=`pwd`

#dnf update -y

#dnf install mysql httpd php php-cli php-gd php-curl php-zip php-mbstring php-mysqlnd -y

#systemctl start mysqld
#systemctl enable mysqld

#systemctl start httpd
#systemctl enable httpd

echo "Введіть пароль від MYSQL root:"
mysql -u root -p < $DIR/bluebirdhotel.sql

#cp -r $DIR /var/www/html/

#systemctl restart httpd

echo "Сайт запущено: http://localhost:80/Hotel-Management-System/index.php"
