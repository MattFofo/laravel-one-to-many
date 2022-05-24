<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 12; $i++) {
            $userData = [
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'password'  => Hash::make('asdfasdf')
            ];

            User::create($userData);
        }
    }
}
