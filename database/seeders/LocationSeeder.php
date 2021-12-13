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
            'destinaton' => 'Lakowe',
            'amount' => range(500, 2000, 100),
            'status' => 1
        ]
        );

        Location::create([
            'name' => 'Ajah',
            'destinaton' => 'Ibeju',
            'amount' => range(500, 2000, 100),
            'status' => 1
        ]
        );

        Location::create([
            'name' => 'Lakowe',
            'destinaton' => 'Lekki',
            'amount' => range(500, 2000, 100),
            'status' => 1
        ]
        );
    }
}
