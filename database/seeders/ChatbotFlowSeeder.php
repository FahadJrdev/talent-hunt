<?php

namespace Database\Seeders;

use App\Models\ChatbotFlow;
use Illuminate\Database\Seeder;

class ChatbotFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatbotFlow::factory()->count(5)->create();
    }
}
