<?php

namespace Database\Seeders;

use App\Models\Plan; 
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plansData = config('plansSeeder');

        foreach ($plansData as $plan) {
            $newPlan = new Plan();
            $newPlan->name = $plan['name'];
            $newPlan->price = $plan['price'];
            $newPlan->save();
        }
    }
}
