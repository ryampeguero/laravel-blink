<?php

namespace Database\Seeders;

use App\Models\Flat;
use App\Models\User;
use Faker\Provider\sv_SE\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Http;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addressArray = config('flatsSeeder');
        $usersArray = User::all();
        
        foreach ($usersArray as $key=>$user) {
            $currAddress = $addressArray[$key];
            $faker = Faker::create("it_IT");
            $newFlat = new Flat();
            $newFlat->name = $faker->word();
            $newFlat->rooms = $faker->numberBetween(1, 20);
            $newFlat->bathrooms = $faker->numberBetween(1, 20);
            $newFlat->beds = $faker->numberBetween(1, 20);
            $newFlat->address = $currAddress['streetName'];
            //Getting Coordinates from API
            $coords = $this->getCoord($currAddress);
            //Setting random addresses coordinates

            $newFlat->latitude = $coords['lat'];
            $newFlat->longitude = $coords['lon'];

            $newFlat->visible = $faker->numberBetween(0, 1);
            $newFlat->slug = Str::slug($newFlat->name . $user->id);
            $newFlat->user_id = $user->id;
            $newFlat->save();
        }
    }

    public function getCoord($address)
    {
        $apiKey = 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26';
        $urlApi = 'https://api.tomtom.com/search/2/structuredGeocode.json';
        // dd($address);

        $response = Http::get($urlApi, [
            'key' => $apiKey,
            'streetName' => $address['streetName'],
            'streetNumber' => $address['streetNumber'],
            'municipality' => $address['municipality'],
            'countryCode' => 'IT',
            'limit' => '1',
            'verify' => false
        ]);
        $data = $response->json();
        // dd($data['results'][0]['position']);
        return $data['results'][0]['position']; //Coordinates
    }
}
