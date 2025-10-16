<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $user = User::factory()->create();
        return [
            'name' => $this->faker->sentence(nbWords: 4),
            'descripton' => $this->faker->optional()->paragraph(),
            'image_path' => $this->faker->optional()->imageUrl(640, 470, 'abstract'),
            'status' => $this->faker->randomElement(array: ['pending', 'on_hold', 'cancelled', 'completed', 'in_progress']),
            'priority' => $this->faker->randomElement(array: ['low', 'medium', 'high']),
            'due_date' => $this->faker->dateTimeBetween(startDate: 'now', endDate: '+3 months'),
            'asigned_user_id' => $this->faker->optional()->randomElement(array: [User::factory(), null]),
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'category_id' => Category::factory(),
            'project_id' => Project::factory()
        ];
    }
}
