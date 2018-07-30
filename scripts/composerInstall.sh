#!/bin/bash
cd /var/www/html/kltn && sudo composer install && sudo /etc/init.d/mysql start > /var/log/install.out 2>&1