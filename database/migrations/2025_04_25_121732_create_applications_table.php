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

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_position_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('applicant_name');
            $table->string('applicant_email');
            $table->string('applicant_phone')->nullable();
            $table->string('cv_file_path')->nullable();
            $table->json('additional_info')->nullable();
            $table->enum('status', ["new","reviewed","interview_scheduled","rejected","hired"])->default('new');
            $table->longText('notes')->nullable();
            $table->timestamp('last_status_change')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
