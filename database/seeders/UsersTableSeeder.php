<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = config('usersSeeder');

        foreach ($usersData as $user) {
            # code...
            $faker = Faker::create("it_IT");
            $newUser = new User();
            $newUser->name = $user["name"];
            $newUser->surname = $user["surname"];
            $newUser->email = $user["email"];
            $newUser->password = $faker->password();
            $newUser->date_of_birth = $faker->dateTimeInInterval("-50 years", "-18 years");
            $newUser->save();
        }
    }
}
