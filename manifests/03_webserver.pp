class { 'apache':
    default_vhost => false,
    mpm_module    => 'prefork',
    purge_configs => true,
}

include 'apache::mod::php', 'apache::mod::ssl', 'apache::mod::rewrite'

apache::vhost { 'smartlab-ssl':
    servername => 'openbike.byte.cat',
    port    => '443',
    ssl     => true,
    docroot => '/vagrant/web',
    directories => [
        {
            'path' => '/vagrant/web',
            'options' => [ '-MultiViews' ],
            'allow_override' => ['None'],
            'require' => 'all granted',
            'custom_fragment' => 'RewriteEngine On
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ app.php [QSA,L]',
        }
    ],
    setenv => [
        'SYMFONY_ENV dev',
    ],
}

apache::vhost { 'smartlab':
    servername => 'openbike.byte.cat',
    docroot => '/vagrant/web',
    directories => [
        {
            'path' => '/vagrant/web',
            'options' => [ '-MultiViews' ],
            'allow_override' => ['None'],
            'require' => 'all granted',
            'custom_fragment' => 'RewriteEngine On
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ app.php [QSA,L]',
        }
    ],
    setenv => [
        'SYMFONY_ENV dev',
    ],
}

include 'php'

# Install extensions -> Configure extensions -> reload webserver
Php::Extension <| |> -> Php::Config <| |> ~> Service['apache2']

class { ['php::cli', 'php::composer', 'php::extension::mysql']:
}

class { ['php::extension::mongo']:
    provider => 'apt',
    package => 'php5-mongo'
}
