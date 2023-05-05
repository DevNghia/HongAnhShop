## Installation Guid

### Prerequisite

**Install PHP 8.2**

```bash
sudo apt install php8.2 php8.2-{fpm,tidy,gd,intl,mysql,odbc,opcache,soap,dev,curl,bz2,bcmath,json,mbstring,xml,zip,memcached} php-redis
```

### Install dependencies

Fresh install

```bash
composer install
```

If you were working on the project before, please update with

```bash
composer update nothing
```

### Development

Laravel run these commands for fixing storage permission

```bash
sudo chown -R $USER:www-data storage
sudo chmod -R 775 storage
```

Setting .env ( copy file .env.example create file .env)

```bash
APP_URL=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elaravel
DB_USERNAME=root
DB_PASSWORD=

```

Generate a new Application Key

```bash
php artisan key:generate
```

Run the migration and seeds

```bash
php artisan migrate

```

Run project

```bash
php artisan serve --port=8000
```

open link run serve project

```bash
http://localhost:8000
```
