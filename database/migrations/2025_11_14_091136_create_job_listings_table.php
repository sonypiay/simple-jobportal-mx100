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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('title');
            $table->text('description');
            $table->text('qualifications');
            $table->string('location');
            $table->string('employment_type', 30)->comment('full_time|contract|part_time|freelance');
            $table->string('level_experience');
            $table->unsignedBigInteger('minimum_salary')->nullable();
            $table->unsignedBigInteger('maximum_salary')->nullable();
            $table->boolean('is_publish')->default(true);
            $table->char('user_employer_id', 36)->nullable();
            $table->char('job_category_id', 36)->nullable();
            $table->timestamps();

            $table->index('user_employer_id');
            $table->index('job_category_id');
            
            $table->foreign('user_employer_id')->references('id')->on('user_employer')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('job_category_id')->references('id')->on('job_categories')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
