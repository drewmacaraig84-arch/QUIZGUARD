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
        Schema::create('violation_logs', function (Blueprint $table) {
            $table->id('violation_id');
            $table->foreignId('attempt_id')->constrained('attempts', 'attempt_id')->cascadeOnDelete();
            $table->string('violation_type', 45);
            $table->timestamp('occurred_at')->useCurrent();
            $table->integer('duration_seconds')->default(0);
            $table->foreignId('question_id')->nullable()->constrained('questions', 'question_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violation_logs');
    }
};
