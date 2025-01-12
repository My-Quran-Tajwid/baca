#!/bin/sh
# This will run common commands to deploy a latest commit from remote
# This script is intended for subsequent deploy of the applications. For 
# first deploy, consult this project's README.md.
set -e

git pull || { echo 'git pull failed' ; exit 1; }
composer install || { echo 'composer install failed' ; exit 1; }

npm install || { echo 'npm install failed' ; exit 1; }
npm run build || { echo 'npm run build failed' ; exit 1; }

# Optimization https://laravel.com/docs/11.x/deployment#optimization
php artisan optimize:clear || { echo 'php artisan optimize:clear failed' ; exit 1; }
php artisan optimize || { echo 'php artisan optimize failed' ; exit 1; }

# Icon caching https://github.com/blade-ui-kit/blade-icons
php artisan icons:clear || { echo 'php artisan icons:clear failed' ; exit 1; }
php artisan icons:cache || { echo 'php artisan icons:cache failed' ; exit 1; }

# Uncomment if you wish to run migrate together in this script, I
# usually run it seperately
# php artisan migrate