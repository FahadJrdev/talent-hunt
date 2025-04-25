<?php

namespace Database\Seeders;

use App\Models\ChatbotStep;
use Illuminate\Database\Seeder;

class ChatbotStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatbotStep::factory()->count(5)->create();
    }
}
