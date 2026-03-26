<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    use HasFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->name(),
            'description'=>fake()->text(),
            'status'=>fake()->randomElement(['To Do','In Progress','Done']),
            'project_id'=>fake()->numberBetween(0,7),
             'responsable'=>fake()->numberBetween(0,12),
            'deadline'=>fake()->dateTime(),
        ];
    }
}
