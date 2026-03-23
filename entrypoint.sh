#!/bin/bash
set -e

# --- 1. Composer Management ---
if [ ! -d "vendor" ]; then
    echo "No vendor folder found. Performing composer install..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
else
    echo "Vendor folder found. Skipping composer step."
fi

# --- 2. Database Readiness ---
echo "Waiting for database (db:3306) to wake up..."
# This silent loop waits for a successful PDO connection
until php -r "try { new PDO('mysql:host=db;dbname=yii2basic', 'yii2user', 'yii2pass'); exit(0); } catch (Exception \$e) { exit(1); }" > /dev/null 2>&1; do
    echo "Database not ready yet... sleeping 2s"
    sleep 2
done
echo "Database is UP!"

# # 2. NUKE AND PAVE (The "Demo" Reset)
# # This drops all tables and runs all migrations from the beginning.
# echo "Wiping database and running fresh migrations..."
# echo "Dropping all tables manually..."
# php yii db/truncate-all || true
# php yii migrate/down all --interactive=0 || true
# php yii migrate/fresh --interactive=0

# --- 3. Migrations ---
echo "Running migrations..."
php yii migrate --migrationPath=@mdm/admin/migrations --interactive=0
php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0
php yii migrate --migrationPath=@petersonsilvadejesus/imagemanager/migrations --interactive=0
php yii migrate --interactive=0

# --- 4. Permission Fix ---
# Ensures the webserver can write to assets and runtime immediately
echo "Fixing permissions..."
chmod -R 777 runtime web/assets
chmod -R 777 runtime images

# --- 5. Start Apache ---
echo "Starting Apache..."
exec apache2-foreground