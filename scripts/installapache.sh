#!/bin/bash
# yum -y install httpd > /var/log/installapache.out 2>&1
yum install -y httpd24 php72 mysql56-server php72-mysqlnd > /var/log/installapache.out 2>&1