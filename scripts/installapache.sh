#!/bin/bash
# yum -y install httpd > /var/log/installapache.out 2>&1
yum install -y httpd24 php70 mysql56-server php70-mysqlnd> /var/log/installapache.out 2>&1