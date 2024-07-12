<?php

namespace Database\Seeders;

use App\Models\Flat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersArray = User::all();
        foreach ($usersArray as $user) {
            $faker = Faker::create("it_IT");
            $newFlat = new Flat();
            $newFlat->rooms = $faker->numberBetween(1, 20);
            $newFlat->slug = Str::slug();
        }
    }
}
