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
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'admin@mail.com',
            'password' =>bcrypt('Hofftech2020'),
            'role' => 'admin',
        ]
        );

        User::create([
            'firstname' => 'Mishael',
            'lastname' => 'Driver',
            'email' => 'driver@mail.com',
            'password' =>bcrypt('password'),
            'role' => 'driver',
        ]
        );

        User::create([
            'firstname' => 'John',
            'lastname' => 'Driver 2',
            'email' => 'driver2@mail.com',
            'password' =>bcrypt('password'),
            'role' => 'driver',
        ]
        );

        User::create([
            'firstname' => 'Nonso',
            'lastname' => 'Driver 3',
            'email' => 'driver3@mail.com',
            'password' =>bcrypt('password'),
            'role' => 'driver',
        ]
        );

        User::create([
            'firstname' => 'tola',
            'lastname' => 'user',
            'email' => 'advs@mail.com',
            'password' =>bcrypt('John'),
        ]
        );
    }
}
