<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $endDate = fake()->optional(0.7)->dateTimeBetween($startDate, '+1 day');

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->optional(0.8)->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => fake()->optional(0.7)->address(),
            'status' => fake()->randomElement(['upcoming', 'ongoing', 'completed', 'cancelled']),
            'capacity' => fake()->optional(0.6)->numberBetween(10, 500),
        ];
    }
}
