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
        Schema::create('applied_jobs', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('user_candidate_id', 36)->nullable();
            $table->char('job_id', 36);
            $table->string('status', 20)->comment('pending|review|invite|process|negotiate|approve|reject|complete');
            $table->string('cover_letter', 255)->nullable()->comment('uploaded file');
            $table->string('resume', 255)->nullable()->comment('uploaded file');
            $table->timestamps();

            $table->index('user_candidate_id');
            $table->index('job_id');

            $table->foreign('user_candidate_id')->references('id')->on('user_candidate')->nullOnDelete();
            $table->foreign('job_id')->references('id')->on('job_listings')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applied_jobs');
    }
};
