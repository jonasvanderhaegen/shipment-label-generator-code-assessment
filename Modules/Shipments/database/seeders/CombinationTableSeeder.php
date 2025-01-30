<?php

namespace Modules\Shipments\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Modules\Shipments\Models\Combination;

class CombinationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = config('shipments.id.company');

        $response = Http::withBasicAuth(config('shipments.api.username'), config('shipments.api.password'))
            ->get(config('shipments.api.url_old')."companies/{$company}/products");

        if ($response->failed()) {
            return;
        }

        /** @var array<int, array<string, mixed>> $data */
        $data = $response->json('data');

        /** @var Collection<int, array<string, mixed>> $collection */
        $collection = collect($data);

        /** @var array<int, array<string, mixed>> $combinations */
        $combinations = $collection->flatMap(fn (array $item): array => $item['combinations'])->all();

        foreach ($combinations as $combination) {
            if (in_array($combination['id'], [14, 38], true)) {
                continue;
            }

            Combination::create([
                'option_id' => $combination['id'],
                'name' => $combination['name'],
            ]);
        }
    }
}
