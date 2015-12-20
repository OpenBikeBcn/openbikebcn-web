#!/bin/bash
rm -rf app/cache/*
rm -rf app/logs/*
HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -Rn -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
sudo setfacl -dRn -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
sudo chmod -R 777 app/cache app/logs
