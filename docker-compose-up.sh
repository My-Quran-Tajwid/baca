#!/bin/bash

# Create required directories
mkdir -p docker/nginx/conf.d
mkdir -p docker/php
mkdir -p docker/mysql

# Make sure configuration files exist
if [ ! -f "docker/nginx/conf.d/app.conf" ]; then
    echo "Creating nginx configuration..."
fi

if [ ! -f "docker/php/local.ini" ]; then
    echo "Creating PHP configuration..."
fi

if [ ! -f "docker/mysql/my.cnf" ]; then
    echo "Creating MySQL configuration..."
fi

# Start docker services
docker-compose up -d

# Install composer dependencies if needed
docker-compose exec app composer install

# Generate application key if not exists
docker-compose exec app php artisan key:generate --ansi

echo "Docker environment is ready!"
echo "Your Laravel application is running at http://localhost"
