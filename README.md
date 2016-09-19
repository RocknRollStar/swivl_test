swivl_test
==========
composer install

app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console doctrine:fixtures:load

A Symfony project created on September 19, 2016, 3:21 pm.
