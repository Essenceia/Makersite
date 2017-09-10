#!/usr/bin/env bash

USER=admin
sudo /etc/init.d/mysql start
mysql -u ${USER} &
php artisan serve --port=8080 &
php artisan queue:listen database