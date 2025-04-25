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

        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('department');
            $table->longText('description');
            $table->longText('requirements');
            $table->longText('responsibilities');
            $table->string('location');
            $table->string('salary_range')->nullable();
            $table->enum('status', ["active","inactive"])->default('active');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_positions');
    }
};
