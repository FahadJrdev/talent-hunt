<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ChatbotFlow;
use App\Models\ChatbotStep;

class ChatbotStepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChatbotStep::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'flow_id' => ChatbotFlow::factory(),
            'step_order' => fake()->numberBetween(-10000, 10000),
            'message_text' => fake()->text(),
            'step_type' => fake()->randomElement(["greeting","question","file_request","confirmation","end"]),
            'expected_response_type' => fake()->randomElement(["text","file","selection","none"]),
            'options' => '{}',
            'validation_rules' => '{}',
            'next_step_logic' => '{}',
        ];
    }
}
