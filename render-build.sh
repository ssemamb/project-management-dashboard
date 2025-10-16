#!/usr/bin/env bash
# exit on error
set -o errexit

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Seeding database with demo data..."
php artisan db:seed --force

echo "Creating storage link..."
php artisan storage:link || true

echo "Optimizing Filament..."
php artisan filament:optimize || true

echo "Installing NPM dependencies..."
npm ci

echo "Building assets..."
npm run build

echo "Build complete!"
```

### **📄 Procfile**

Copy and paste this into your `Procfile` file:
```
web: php artisan serve --host=0.0.0.0 --port=$PORT