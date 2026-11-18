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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id('quiz_id');
            $table->foreignId('teacher_id')->constrained('users', 'user_id');
            $table->foreignId('bank_id')->constrained('question_banks', 'bank_id');
            $table->foreignId('subject_id')->constrained('subjects', 'subject_id');
            $table->string('title', 100);
            $table->string('section', 45);
            $table->integer('time_limit_min');
            $table->integer('max_violation')->default(3);
            $table->integer('passing_score')->default(60);
            $table->integer('attempts_allowed')->default(1);
            $table->boolean('shuffle_questions')->default(false);
            $table->integer('number_of_questions');
            $table->boolean('shuffle_answers')->default(false);
            $table->string('grading_method', 45)->default('highest');
            $table->timestamp('open_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
