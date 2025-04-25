<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Application;
use App\Models\JobPosition;
use App\Models\User;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job_position_id' => JobPosition::factory(),
            'user_id' => User::factory(),
            'applicant_name' => fake()->word(),
            'applicant_email' => fake()->word(),
            'applicant_phone' => fake()->word(),
            'cv_file_path' => fake()->word(),
            'additional_info' => '{}',
            'status' => fake()->randomElement(["new","reviewed","interview_scheduled","rejected","hired"]),
            'notes' => fake()->text(),
            'last_status_change' => fake()->dateTime(),
        ];
    }
}
