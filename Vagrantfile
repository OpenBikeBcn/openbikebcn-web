# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/trusty64"
    config.vm.hostname = "openbikebcn"

    config.vm.network "forwarded_port", guest: 80, host: 8080
    config.vm.network "forwarded_port", guest: 443, host: 8443
    config.vm.network "forwarded_port", guest: 3306, host: 8306
    config.vm.network "forwarded_port", guest: 27017, host: 27018
    config.vm.synced_folder "app/cache", "/vagrant/app/cache", :owner => "www-data", :group => "www-data"
    config.vm.synced_folder "app/logs", "/vagrant/app/logs", :owner => "www-data", :group => "www-data"

    config.vm.provider "virtualbox" do |vb|
        vb.name = "openbikebcn"
        vb.memory = "1024"
    end

    config.vm.provision :shell, path: "provision/00_puppet.sh"
    config.vm.provision "puppet", manifest_file: "01_system.pp"
    config.vm.provision "puppet", manifest_file: "02_database.pp"
    config.vm.provision "puppet", manifest_file: "03_webserver.pp"
    config.vm.provision :shell, path: "provision/04_application.sh"
end
