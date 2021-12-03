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
            'name' => 'Sola',
            'email' => 'adv@mail.com',
            'password' =>bcrypt('Sola'),
            'role' => 'admin',
        ]
        );

        User::create([
            'name' => 'Mishael',
            'email' => 'adva@mail.com',
            'password' =>bcrypt('Mishy'),
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