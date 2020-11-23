<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([  
            'name' => 'andres',
            'perfil' => 'admin',
            'email' => 'monkey.velasquez.1982@gmail.com',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            'password' => '12345',//bcrypt('password'),
        ]);
    }
}
