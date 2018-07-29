#!/bin/bash

cd /var/www/project/
composer install
npm install
gulp --production