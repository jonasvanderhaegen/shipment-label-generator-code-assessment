<?php

use Illuminate\Support\Facades\Route;
use Modules\Shipments\Livewire\Pages\Index;

Route::get('/', Index::class)->name('shipments.index');
