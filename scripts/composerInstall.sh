#!/bin/bash
cd /var/www/html/kltn && sudo cp .env.example .env && sudo rm .env.example && sudo composer install && sudo /etc/init.d/mysql start > /var/log/install.out 2>&1