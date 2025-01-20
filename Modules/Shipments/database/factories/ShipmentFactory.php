<?php

namespace Modules\Shipments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Shipments\Models\Shipment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_number' => '#' . fake()->bothify('#######'),

            'brand_id' => config('shipments.id.brand'),
            'company_id' => config('shipments.id.company'),
            'billing_name' => fake('nl_NL')->name(),
            'billing_company_name' => fake('nl_NL')->company(),
            'billing_street' => fake()->streetName('nl_NL'),
            'billing_housenumber' => (string) fake('nl_NL')->buildingNumber(),
            'billing_zipcode' => fake('nl_NL')->postcode(),
            'billing_city' => fake('nl_NL')->city(),
            'billing_country' => 'NL',
            'delivery_name' => fake('nl_NL')->name(),
            'delivery_company_name' => fake('nl_NL')->company(),
            'delivery_street' => 'Daltonstraat',
            'delivery_housenumber' => '65',
            'delivery_zipcode' => '3316GD',
            'delivery_city' => 'Dordrecht',
            'delivery_country' => 'NL',
            'api_shipment_id' => '9d508bc0-e8be-42c8-859f-d826008cc9a6',
            'api_tracking_id' => '3SQLW0024129778',
            'api_tracking_url' => 'https://goparcel.nl/track/3SQLW0024129778/NL/3316GD',
            'api_label_pdf_url' => 'https://api.pakketdienstqls.nl/v2/companies/9e606e6b-44a4-4a4e-a309-cc70ddd3a103/shipments/9d508bc0-e8be-42c8-859f-d826008cc9a6/labels/pdf',
            'combination_id' => 1
        ];
    }
}

