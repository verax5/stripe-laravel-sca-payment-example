<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        App\User::create(['name' => 'verax5', 'email' => 'phpdevsami@gmail.com', 'password' => \Hash::make('123456')]);
    }
}
