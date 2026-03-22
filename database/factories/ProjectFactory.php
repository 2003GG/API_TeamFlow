<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
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
            'chef_project_id'=>fake()->numberBetween(0,10),
            'description'=>fake()->text(),
            'workspace_id'=>fake()->numberBetween(0,7)
        ];
    }
}
