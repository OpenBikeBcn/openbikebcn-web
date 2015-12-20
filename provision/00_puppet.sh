#!/bin/bash

# update last version of puppet
puppet module install gajdaw-puppet
puppet apply -e "include puppet"

# Prevent Puppet warnings because "templatedir" is deprecated
sudo sed -i s/^templatedir/#templatedir/g /etc/puppet/puppet.conf

puppet module install puppetlabs-apache
puppet module install puppetlabs-mysql
puppet module install puppetlabs-mongodb
puppet module install nodes/php
puppet module install saz-locales
