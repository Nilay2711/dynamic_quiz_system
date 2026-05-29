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
    Schema::create('answers', function (Blueprint $table) {

        $table->id();

        $table->foreignId('attempt_id')
              ->constrained()
              ->onDelete('cascade');

        $table->foreignId('question_id')
              ->constrained()
              ->onDelete('cascade');

        /*
        Stores:
        yes
        25
        Laravel
        JSON array for multiple choice
        */

        $table->longText('answer');

        $table->boolean('is_correct')
              ->default(false);

        $table->decimal('obtained_marks', 8, 2)
              ->default(0);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
