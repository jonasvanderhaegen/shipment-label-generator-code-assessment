<?php

namespace Modules\Shipments\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Shipments\Livewire\Components\ShipmentModalComponent;
use Mockery;

use Modules\Shipments\Observers\ShipmentObserver;
use Modules\Shipments\Models\Shipment;

uses(TestCase::class);
uses(RefreshDatabase::class);


test('index can be rendered with fake data', function () {

    Shipment::unsetEventDispatcher();

    Livewire::test(ShipmentModalComponent::class)
            ->set('form.brand_id', fake()->word) // Brand ID
            ->set('form.company_id', fake()->word) // Company ID
            ->set('form.order_number', '#' . fake()->bothify('#######')) // Order number
            ->set('form.billing_company_name', fake('nl_NL')->company()) // Billing company name
            ->set('form.billing_name', fake('nl_NL')->name()) // Billing name
            ->set('form.billing_street', fake('nl_NL')->streetName()) // Billing street
            ->set('form.billing_housenumber', (string) fake('nl_NL')->buildingNumber()) // Billing house number
            ->set('form.billing_zipcode', fake('nl_NL')->postcode()) // Billing zipcode
            ->set('form.billing_city', fake('nl_NL')->city()) // Billing city
            ->set('form.billing_country', 'NL') // Billing country (fixed to 'NL')
            ->set('form.delivery_company_name', fake('nl_NL')->company()) // Delivery company name
            ->set('form.delivery_name', fake('nl_NL')->name()) // Delivery name
            ->set('form.delivery_street', 'Daltonstraat') // Delivery street (fixed)
            ->set('form.delivery_housenumber', '65') // Delivery house number (fixed)
            ->set('form.delivery_zipcode', '3316GD') // Delivery zipcode (fixed)
            ->set('form.delivery_city', 'Dordrecht') // Delivery city (fixed)
            ->set('form.delivery_country', 'NL') // Delivery country (fixed)
            ->set('form.combination_id', fake()->randomDigitNotNull) // Combination ID
            ->call('save') // Call the save method
            ->assertHasNoErrors(); // Assert there are no validation errors
});

test('tests the ShipmentForm validation rules', function (string $field, mixed $value, string $rule) {
    Livewire::test(ShipmentModalComponent::class)
    ->set($field, $value)
    ->call('save')
    ->assertHasErrors([$field => $rule]);

})->with([
    'brand_id is required' => ['form.brand_id', '', 'required'],
    'company_id is required' => ['form.company_id', '', 'required'],
    'billing_housenumber is required' => ['form.billing_housenumber', '', 'required']
]);
