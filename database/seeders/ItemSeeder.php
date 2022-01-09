<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Items::create([
            'item' => 'Letters',
            'price' => '200.00'
        ]);
        Items::create([
            'item' => 'Documents',
            'price' => '300.00'
        ]);
        Items::create([
            'item' => 'Furniture Items',
            'price' => '50000.00'
        ]);
        
    }
}
