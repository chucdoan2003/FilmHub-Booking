<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run()
    {

        $theaterIds = DB::table('theaters')->pluck('theater_id');


        for ($i = 0; $i < 10; $i++) {
            DB::table('rooms')->insert([
                'theater_id' => $theaterIds->random(),
                'room_name' => 'Phòng ' . ($i + 1),
                'capacity' => rand(15, 30),
                'created_at' => now(),
            ]);
        }
    }
}
