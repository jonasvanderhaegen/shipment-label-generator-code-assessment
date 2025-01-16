<?php

return [
    'name' => 'Shipments',
    'api' => [
        'url_old' => env('SHIPMENTS_API_BASE_URL'),
        'url' => env('SHIPMENTS_API_V2_BASE_URL'),
        'username' => env('SHIPMENTS_API_USERNAME'),
        'password' => env('SHIPMENTS_API_PASSWORD')
    ],
    'id' => [
        'brand' => env('SHIPMENTS_BRAND_ID'),
        'company' => env('SHIPMENTS_COMPANY_ID')
    ]
];
