class { '::mysql::server':
    root_password  => 'openbike',
    override_options => {
        mysqld => {
            'bind_address' => '0.0.0.0',
        }
    }
}
mysql::db { 'openbike':
    user     => 'openbike',
    password => 'openbike',
    host     => '%',
    charset  => 'utf8',
}

class {'::mongodb::server':
    port    => 27017,
}

mongodb::db { 'openbike':
    user => 'openbike',
    password => 'openbike',
}
