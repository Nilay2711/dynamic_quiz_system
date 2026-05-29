<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Quiz
        |--------------------------------------------------------------------------
        */

        $quiz = Quiz::create([

            'title' => 'General Knowledge Quiz',

            'description' =>
                'Demo quiz for assignment testing.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Question 1
        |--------------------------------------------------------------------------
        */

        $question1 = Question::create([

            'quiz_id' => $quiz->id,

            'type' => 'single_choice',

            'question' =>
                'What is the capital of India?',

            'marks' => 2,
        ]);

        Option::create([

            'question_id' => $question1->id,

            'option_text' => 'Delhi',

            'is_correct' => true,
        ]);

        Option::create([

            'question_id' => $question1->id,

            'option_text' => 'Mumbai',

            'is_correct' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Question 2
        |--------------------------------------------------------------------------
        */

        Question::create([

            'quiz_id' => $quiz->id,

            'type' => 'binary',

            'question' =>
                'PHP is a backend language.',

            'correct_answer' => 'yes',

            'marks' => 1,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Question 3
        |--------------------------------------------------------------------------
        */

        Question::create([

            'quiz_id' => $quiz->id,

            'type' => 'number',

            'question' =>
                'What is 5 + 5?',

            'correct_answer' => '10',

            'marks' => 1,
        ]);
    }
}