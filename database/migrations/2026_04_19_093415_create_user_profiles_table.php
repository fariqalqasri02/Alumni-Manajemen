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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('address')->nullable();
            $table->unsignedSmallInteger('graduation_year')->nullable();
            $table->string('study_program')->nullable();
            $table->text('education_history')->nullable();
            $table->text('skills')->nullable();
            $table->text('work_experience')->nullable();
            $table->string('current_company')->nullable();
            $table->string('current_position')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
