<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JobPosition;
use App\Models\User;

class JobPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobPosition::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'department' => fake()->word(),
            'description' => fake()->text(),
            'requirements' => fake()->text(),
            'responsibilities' => fake()->text(),
            'location' => fake()->word(),
            'salary_range' => fake()->word(),
            'status' => fake()->randomElement(["active","inactive"]),
            'created_by' => User::factory()->create()->id,
        ];
    }
}
