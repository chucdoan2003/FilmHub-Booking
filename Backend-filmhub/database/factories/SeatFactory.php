<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => 1,
            'seat_number' => fake()->numberBetween(1, 50),
            'seat_type' => fake()->randomElement(['standard', 'vip']),
            'status' => fake()->randomElement(['available', 'booked'])
        ];
    }
}
