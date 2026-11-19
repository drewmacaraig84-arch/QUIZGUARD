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
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->foreignId('bank_id')->constrained('question_banks', 'bank_id')->cascadeOnDelete();
            $table->text('question_text');
            $table->string('question_type', 45);
            $table->text('options')->nullable();
            $table->string('correct_answers', 255);
            $table->integer('points')->default(1);
            $table->string('status', 45)->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
