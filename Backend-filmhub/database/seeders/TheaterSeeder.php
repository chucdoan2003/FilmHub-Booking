<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theater;
use Faker\Factory as Faker;

class TheaterSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Theater::create([
                'name' => $faker->company,
                'location' => $faker->address,
               'capacity' => $faker->numberBetween(1, 10),
                'created_at' => now(),
            ]);
        }
    }
}
