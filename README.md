<p align="center"><img width="300" src="https://raw.githubusercontent.com/livewire/livewire/main/art/logo.svg" alt="Livewire Logo"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="250" alt="Laravel Logo"></a></p>
<p align="center"></p>

<p><img width="100%" src="/examples/screenshots/1. standard.png" alt="Livewire Logo"></p>

[Pdf outputs](/examples/pdfs) | [Screenshots](/examples/screenshots)

This was quite a fun code assessment to do, I enjoyed programming this mostly with Laravel and Livewire. 

The only thing that bothered me is that the full page components update the whole page with very action, it detaches flowbite's javascript, which is why I've to remove Flowbite's html properties and replace with livewire variables and php logic so it persists when doing click actions that update the components. For example the accordeon was with javascript, but everytime I start to type in a field it updates the whole modal component and resets the DOM elements to its original start and detach Flowbite javascript, it doesn't anything anymore after.

For combining the label and order information I initially thought to resize the api's pdf label to A5, then generate another PDF in portrait in A5 format. Then concatenate them next to each other. 2 A5's in portrait make 1 A4 in landscape mode.


## Known problems

- Select Belgium as delivery country and submit throws guaranteed error (not sure why yet);
- ~~Submitting modal form currently shows no indication of loading/processing until it's finished;~~

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

## Workflow

#### Create shipment

1. (wire:)click on green button will open the livewire component modal, it has a form for order/billing/delivery/delivery method dropdown, the livewire form component validates the fields live with a debounce.

2. By default all panels are closed and disabled except for order information, when all fields of a certain section are valid, the next panel is no longer disabled and the user can continue. this is due to computed properties. Pretty handy!

3. The user submits a form, this creates the model Shipment with the all form fields values.

4. This fires a created (observer) event, the dedicated listener then starts a pipeline of classes. I will eventually replace it with queues but this will do.

5. Pipeline
    1. FetchShipmentData = send POST request to api endpoint to create a shipment, store the data that returns in shipment, useful for the next pipe.
    2. FetchShippingLabel = send GET request to api endpoint to retrieve base64 string, then continue to next pipe.
    3. StoreTemporaryPdf = convert the base64 string as temporary file, resize it to A5. this is for the right side of the eventual pdf file.
    4. GeneratePdf = generate a pdf file in A5 format portrait with spatie/laravel-ray, it converts blade php file to pdf file. This is the left side.
    5. ConcatenatePdfs = Make a new A4 format pdf file, put the left side on it first, then the right side and save the file in storage.
    6. CleanUpTemporaryFiles = Delete the temporary files.

I added a artisan console command to view the outcome of the pipeline without having to use the form over and over again.
This will do the same as what happens on form submit except for FetchShipmentData right now.

 t g p p, short for TestGeneratePdfPipeline

```bash
pdf:tgpp <shipment ID>
```


  
#### Delete shipment

1. The user deletes a shipment after confirm prompt from the client browser.

2. This fires a deleted (observer) event, the listener deletes the relevant file from storage.

3. In the delete function call the function resetPage so the paginator resets to page 1. In case there's 1 shipment left on this page and the shipment dissapears the url otherwise stays at current page with zero shipments. Therefore the page must be reset. Technicall I could just let it redirect to the page before of the paginator.


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

### Developer tools

[Ray from spatie](https://spatie.be/products/ray)

2 module generators from 'mhmiton/laravel-modules-livewire' and 'nwidart/laravel-modules'.
