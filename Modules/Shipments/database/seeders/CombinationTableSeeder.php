<?php

namespace Modules\Shipments\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Shipments\Models\Combination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class CombinationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = config('shipments.id.company');

        $response = Http::withBasicAuth(config('shipments.api.username'), config('shipments.api.password'))
        ->get(config('shipments.api.url_old') . "companies/{$company}/products");

        if($response->failed()) return;

        $data = $response->json('data');

        $combinations = collect($data)
        ->flatMap(function ($item) {
            return $item['combinations'];
        })
        ->all();

        foreach($combinations as $combination) {

            if (in_array($combination['id'], [14, 38])) continue;

            Combination::create([
                'option_id' => $combination['id'],
                'name' => $combination['name']
            ]);
        }
    }
}
