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
        
        $locations = [
            'Agege', 
            'Ajah', 
            'Alimosho', 
            'Amuwo-Odofin', 
            'Apapa', 
            'Awoyaya',
            'Badagry', 
            'Bariga',
            'Ebute-Meta',
            'Epe', 
            'Eleko',
            'Festac Town',
            'Gbagada', 
            'Ibeju-Lekki', 
            'Ikeja', 
            'Ikorodu', 
            'Ikorodu Road',
            'Ikoyi',
            'Ilupeju',
            'Ipaja',
            'Isolo',
            'Lakowe',
            'Lekki I',
            'Lekki II', 
            'Magodo',
            'Maryland',
            'Ogudu', 
            'Ojodu',
            'Ojota',
            'Oniru',
            'Orile',
            'Oshodi',
            'Palmgrove',
            'Sangotedo',
            'Satellite Town', 
            'Shomolu', 
            'Surulere', 
            'VGC',
            'Victoria Island',
            'Yaba'
        ];
        foreach ($locations as $location) {
            Location::create([
                'location' => $location
            ]);
        }
    }
}
