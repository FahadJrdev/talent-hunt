<?php

namespace Database\Seeders;

use App\Models\ConversationLog;
use Illuminate\Database\Seeder;

class ConversationLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConversationLog::factory()->count(5)->create();
    }
}
