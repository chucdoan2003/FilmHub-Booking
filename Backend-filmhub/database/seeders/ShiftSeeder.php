<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;
use App\Models\Theater;
use App\Models\Room;
use Faker\Factory as Faker;

class ShiftSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();


        $theaterIds = Theater::pluck('theater_id')->toArray();
        $roomIds = Room::pluck('room_id')->toArray();

        if (empty($theaterIds)) {

            echo "Không có theater_id nào trong bảng theaters.";
            return;
        }

        for ($i = 1; $i <= 3; $i++) {
            $randomTheaterId = $faker->randomElement($theaterIds);
            $randomRoomId = $faker->randomElement($roomIds);
            Shift::create([
                'theater_id' => $randomTheaterId,
                'room_id' => $randomRoomId,
                'shift_name' => 'Ca ' . $i,
                'start_time' => $faker->time($format = 'H:i', $max = 'now'),
                'end_time' => $faker->time($format = 'H:i', $max = 'now')
            ]);
        }
    }
}
