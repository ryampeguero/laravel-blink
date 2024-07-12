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
            $newFlat->name = $faker->word();
            $newFlat->rooms = $faker->numberBetween(1, 20);
            $newFlat->bathrooms = $faker->numberBetween(1, 20);
            $newFlat->beds = $faker->numberBetween(1, 20);
            $newFlat->address = $faker->streetAddress();
            $newFlat->latitude = $faker->numberBetween(1000, 5000);
            $newFlat->longitude = $faker->numberBetween(1000, 5000);
            $newFlat->visible = $faker->numberBetween(0, 1);
            $slug = strval($newFlat->rooms);
            $newFlat->slug = Str::slug($newFlat->name . $slug);
            $newFlat->user_id = $user->id;
            $newFlat->save();
        }
    }
}
