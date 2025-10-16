<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $start_date = $this->faker->dateTimeBetween(startDate: '-6 months', endDate: 'now');
        $end_date = $this->faker->dateTimeBetween(startDate: $start_date, endDate: '+1year');
        return [
            'name' => $this->faker->sentence(nbWords: 3),
            'description' => $this->faker->paragraph(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'image_path' => $this->faker->optional()->imageUrl(640, 470,  'business'),
            'status' => $this->faker->randomElement(array: ['pending', 'on_hold', 'cancelled', 'completed', 'in_progress']),
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'Category_id' => Category::factory(),
            'client_id' => Client::factory(),

        ];
    }
}
