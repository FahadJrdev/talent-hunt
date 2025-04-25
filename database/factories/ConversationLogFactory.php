<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Application;
use App\Models\ChatbotStep;
use App\Models\ConversationLog;

class ConversationLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConversationLog::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'application_id' => Application::factory(),
            'step_id' => ChatbotStep::factory(),
            'user_message' => fake()->text(),
            'bot_message' => fake()->text(),
            'file_uploaded' => fake()->boolean(),
            'file_path' => fake()->word(),
            'session_id' => fake()->word(),
        ];
    }
}
