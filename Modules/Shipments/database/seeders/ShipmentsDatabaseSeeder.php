<?php

namespace Modules\Shipments\Database\Seeders;

use Illuminate\Database\Seeder;

class ShipmentsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CombinationTableSeeder::class
        ]);
    }
}
