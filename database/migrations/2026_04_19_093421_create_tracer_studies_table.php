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
        Schema::create('tracer_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('employment_status', ['bekerja', 'wirausaha', 'studi_lanjut', 'belum_bekerja']);
            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();
            $table->unsignedTinyInteger('relevance_level')->comment('1-5');
            $table->unsignedInteger('waiting_period_months')->default(0);
            $table->decimal('salary', 15, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->year('survey_year');
            $table->unique(['user_id', 'survey_year']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_studies');
    }
};
