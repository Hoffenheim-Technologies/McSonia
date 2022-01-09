<?php

namespace Database\Seeders;

use App\Models\Pricing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(PricingSeeder::class);
        $this->call(VehiclesSeeder::class);
        $this->call(StateSeeder::class);
    }
}
