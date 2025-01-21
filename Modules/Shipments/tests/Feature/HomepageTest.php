<?php

namespace Modules\Shipments\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Shipments\Livewire\Pages\Index;

uses(TestCase::class);
uses(RefreshDatabase::class);

test('index can be rendered', function () {
    // return true;
    Livewire::test(Index::class)
            ->assertStatus(200);
});
