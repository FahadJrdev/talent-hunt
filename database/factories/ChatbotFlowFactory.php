<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ChatbotFlow;
use App\Models\JobPosition;
use App\Models\User;

class ChatbotFlowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChatbotFlow::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job_position_id' => JobPosition::factory(),
            'name' => fake()->name(),
            'is_active' => fake()->boolean(),
            'created_by' => User::factory()->create()->id,
        ];
    }
}
