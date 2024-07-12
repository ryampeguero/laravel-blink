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
        for ($i=0; $i < 12; $i++) { 
            $faker = Faker::create("it_IT");
            $newUser = new User();
            $newUser->name = $faker->firstName();
            $newUser->surname = $faker->lastName();
            $newUser->email = $faker->email();
            $newUser->password = $faker->password();
            $newUser->date_of_birth = $faker->dateTimeInInterval("-50 years", "-18 years");
            $newUser->save();
        }
    }
}
