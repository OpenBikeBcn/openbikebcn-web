#!/bin/bash
cd /vagrant
cp app/config/parameters.yml.dist app/config/parameters.yml
composer install
sudo -u www-data php app/console doctrine:database:drop --force
sudo -u www-data php app/console doctrine:database:create
sudo -u www-data php app/console doctrine:schema:update --force
