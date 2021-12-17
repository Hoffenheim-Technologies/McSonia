<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Database\Seeder;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicles::create([
            'vehicle_name' => 'Bike 1',
            'user_id' => User::where('role', 'like', 'driver')->get()->random()->id,
            'reg_no' => 'BJH 294 AS',
            'type' => 'Motorcycle',
            'description' => 'Sound Blue Bike',
            'make' => 'Jin Cheng',
            'year' => '2006',
            'model' => 'Honarary',
            'condition' => 'Used',
            'status' => 'Active'
        ]);

        Vehicles::create([
            'vehicle_name' => 'Car 1',
            'user_id' => User::where('role', 'like', 'driver')->get()->random()->id,
            'reg_no' => 'JJJ 987 AS',
            'type' => 'Car',
            'description' => 'Red Saloon Car',
            'make' => 'Honda',
            'year' => '2012',
            'model' => 'Accord',
            'condition' => 'New',
            'status' => 'Inactive'
        ]);
    }
}
