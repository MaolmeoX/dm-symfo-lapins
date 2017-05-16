# Rights settings.
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs

# Installation des dépendances php
composer install
# Installation des dépendances front (bootstrap, fontawesome, jquery)
bower install

# Création bdd
php app/console doctrine:database:drop --force -q
php app/console doctrine:database:create
# Création de la structure de la bdd
php app/console doctrine:schema:update --force
#Installation des assets
php app/console assets:install web
#Population de la bdd
php app/console doctrine:fixtures:load -q
#Clear cache
php app/console cache:clear