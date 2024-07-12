<?php

namespace Database\Seeders;

use App\Models\Flat;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class FlatServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flatArray = Flat::all();
        $serviceArray = Service::all();
        $faker = Faker::create("it_IT");
        foreach ($flatArray as $flat) {
            foreach ($serviceArray as $service) {
                $service->flats()->attach($flat->id);
                if($faker->numberBetween(0,1)){
                    $flat->services()->sync($service->id);
                }
            }
        }

    }
}
