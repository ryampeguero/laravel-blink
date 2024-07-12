<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicesData = config('servicesSeeder');
        // dd($servicesData);
        foreach ($servicesData as $service) {
            $newService = new Service();
            $newService->name = $service['name'];
            $newService->icon = $service['icon'];
            $newService->save();
        }
    }
}
