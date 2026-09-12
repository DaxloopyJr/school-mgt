#!/bin/bash
set -e

# Start MariaDB
mkdir -p /run/mysqld && chown mysql:mysql /run/mysqld
if [ ! -d /var/lib/mysql/mysql ]; then
    mariadb-install-db --user=mysql --datadir=/var/lib/mysql >/dev/null 2>&1
fi
mysqld_safe --datadir=/var/lib/mysql &

# Wait for MySQL
for i in $(seq 1 30); do
    if mariadb-admin ping >/dev/null 2>&1; then break; fi
    sleep 1
done

mariadb -e "CREATE DATABASE IF NOT EXISTS school_mgt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

cd /var/www/html
php artisan key:generate --force
php artisan storage:link --force 2>/dev/null || true
php artisan migrate --seed --force

exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
