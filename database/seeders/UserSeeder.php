<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Sola Admin',
            'email' => 'admin@mail.com',
            'password' =>bcrypt('password'),
            'role' => 'admin',
        ]
        );

        User::create([
            'name' => 'Mishael Driver',
            'email' => 'driver@mail.com',
            'password' =>bcrypt('password'),
            'role' => 'driver',
        ]
        );

        User::create([
            'name' => 'tola',
            'email' => 'advs@mail.com',
            'password' =>bcrypt('John'),
        ]
        );
    }
}
