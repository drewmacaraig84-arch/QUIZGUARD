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
        Schema::create('attempts', function (Blueprint $table) {
            $table->id('attempt_id');
            $table->foreignId('quiz_id')->constrained('quizzes', 'quiz_id');
            $table->foreignId('student_id')->constrained('users', 'user_id');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('submitted_at')->nullable();
            $table->integer('score')->default(0);
            $table->integer('total_points')->default(0); 
            $table->string('status', 45)->default('ongoing');
            $table->integer('violation_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
