<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\JobPositionSeeder;
use Database\Seeders\ApplicationSeeder;
use Database\Seeders\ChatbotFlowSeeder;
use Database\Seeders\ChatbotStepSeeder;
use Database\Seeders\ConversationLogSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            JobPositionSeeder::class,
            ApplicationSeeder::class,
            ChatbotFlowSeeder::class,
            ChatbotStepSeeder::class,
            ConversationLogSeeder::class,
        ]);
    }
}
