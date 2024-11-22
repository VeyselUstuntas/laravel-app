#!/bin/bash
set -e

echo "waiting myssql"

/var/www/html/wait-for-it.sh mysql:3306 --timeout=20 -- echo mysql up

echo "Starting migrations..."
php artisan migrate:fresh

echo "Starting seeding..."
php artisan db:seed

echo "Starting Apache..."
apache2-foreground
