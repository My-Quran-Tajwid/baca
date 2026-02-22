#!/bin/sh
# This will run common commands to deploy a latest commit from remote
# This script is intended for subsequent deploy of the applications. For 
# first deploy, consult this project's README.md.
set -e

echo "Deploy triggered by user: $(whoami) on $(date)"

git pull --recurse-submodules
composer install 

npm ci 
npm run build 

# Optimization https://laravel.com/docs/11.x/deployment#optimization
php artisan optimize:clear 
php artisan optimize 

# Icon caching https://github.com/blade-ui-kit/blade-icons
php artisan icons:clear 
php artisan icons:cache 

echo 'Deployment successful.'