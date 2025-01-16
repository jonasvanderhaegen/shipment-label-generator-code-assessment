<p align="center"><img width="300" src="https://raw.githubusercontent.com/livewire/livewire/main/art/logo.svg" alt="Livewire Logo"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="250" alt="Laravel Logo"></a></p>
<p align="center"></p>

<p><img width="100%" src="/examples/screenshots/1. standard.png" alt="Livewire Logo"></p>

This was quite a fun code assessment to do, I enjoyed programming this mostly with Laravel and Livewire. 

The only thing that bothered me is that the full page components update the whole page with very action so it detaches flowbite's javascript so I've to remove Flowbite's html properties and replace with livewire variables and php logic so it persists when doing action. Like let's say the accordeon was with javascript, but everytime I start to type in a field it updates the component and detach resets the html to original and detached Flowbite javascript so it doesn't anything anymore.

For combining the label and order information I initially thought to resize the api's pdf label to A5, then generate another PDF in portrait in A5 format. Then concatenate them next to each other. 2 A5's in portrait make 1 A4 in landscape mode.


## Known problems

- Selecting Belgium as delivery country and submitting throws guaranteed error (not sure why yet);
- Submitting modal form currently shows no indication of loading/processing until it's finished;

## Work in progress

- Write pest tests;
- Deal with errors from api more gracefully;
- Add more meaningful typing;
- Refactor code in several livewire components;
- Check coding style (rector);
- Filter index of shipments based on searchform component's query parameter;
- After submitting modal form, show progression in vertical steps. After each pipeline finished have it go down a step;
- Create meaningful blade components to reduce repeating (lot of css classes on html elements) more gracefully;
- Add more meaningful logs and comments to the code;
- Make use of Laravel reverb websocket for small real-time updates;


# Installation & Configuration

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
