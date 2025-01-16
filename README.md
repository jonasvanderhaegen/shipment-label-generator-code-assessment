<p align="center"><img width="300" src="https://raw.githubusercontent.com/livewire/livewire/main/art/logo.svg" alt="Livewire Logo"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="250" alt="Laravel Logo"></a></p>
<p align="center"></p>

<p><img width="100%" src="/examples/screenshots/1. standard.png" alt="Livewire Logo"></p>

Installation & Configuration

#### Step 1

Install dependencies

```bash
composer install

npm install && npm run build
```

#### Step 2

Get .env from .env.example
```bash
cp .env.example .env
```

#### Step 3

Edit the values of variables starting with SHIPMENTS and PDF and APP_URL

composer package spatie/laravel-pdf creates pretty pdf files but requires node and npm so set NODE_PATH 

```bash
which node
```

and NPM_PATH

```bash
which npm
```

Also make a choice to set your database connection, either stays as is or mysql.

#### STEP 4

Let's migrate and seed the database.

```laravel
php artisan migrate --seed
php artisan module:seed Shipments
```
