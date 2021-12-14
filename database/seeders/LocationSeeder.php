<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Location::create([
            'pickup' => 'Ajah',
            'destination' => 'Lakowe',
            'amount' => rand(500, 2000),
            'status' => 1
        ]
        );

        Location::create([
            'pickup' => 'Ajah',
            'destination' => 'Ibeju',
            'amount' => rand(500, 2000),
            'status' => 1
        ]
        );

        Location::create([
            'pickup' => 'Lakowe',
            'destination' => 'Lekki',
            'amount' => rand(500, 2000),
            'status' => 1
        ]
        );
    }
}
