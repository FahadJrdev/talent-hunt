<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('chatbot_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flow_id')->constrained('chatbot_flows');
            $table->integer('step_order');
            $table->longText('message_text');
            $table->enum('step_type', ["greeting","question","file_request","confirmation","end"]);
            $table->enum('expected_response_type', ["text","file","selection","none"]);
            $table->json('options')->nullable();
            $table->json('validation_rules')->nullable();
            $table->json('next_step_logic')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_steps');
    }
};
