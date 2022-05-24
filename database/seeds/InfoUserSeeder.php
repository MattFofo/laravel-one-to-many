<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\InfoUser;

class InfoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();

        foreach ($users as $user) {
            InfoUser::create([
                'user_id'   => $user->id,
                'address'   => $faker->address(),
                'phone'     => $faker->phoneNumber(),
                'birth'     => $faker->date()
            ]);
        }
    }
}
