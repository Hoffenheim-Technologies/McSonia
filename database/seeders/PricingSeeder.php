<?php

namespace Database\Seeders;

use App\Models\Pricing;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pricing::create([
            'pickup_id' => 1,
            'dropoff_id' => 2,
            'price' => 4000.00
        ]);
        Pricing::create([
            'pickup_id' => 1,
            'dropoff_id' => 3,
            'price' => 9000.00
        ]);
        Pricing::create([
            'pickup_id' => 4,
            'dropoff_id' => 7,
            'price' => 2000.00
        ]);
        Pricing::create([
            'pickup_id' => 12,
            'dropoff_id' => 5,
            'price' => 1000.00
        ]);
    }
}
