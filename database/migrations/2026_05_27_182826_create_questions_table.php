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

        $table->id();

        $table->foreignId('quiz_id')
              ->constrained()
              ->onDelete('cascade');

        /*
        Types:
        binary
        single_choice
        multiple_choice
        number
        text
        */

        $table->string('type');

        $table->longText('question');

        $table->string('image')->nullable();

        $table->string('video_url')->nullable();

        $table->decimal('marks', 8, 2)->default(1);

        /*
        For:
        binary => true
        number => 25
        text => Laravel
        */

        $table->text('correct_answer')->nullable();

        $table->integer('sort_order')->default(0);

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
