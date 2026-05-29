<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\Attempt;
use App\Models\Answer;

class QuizEvaluationService
{
    protected QuestionHandlerService $handlerService;

    public function __construct()
    {
        $this->handlerService = new QuestionHandlerService();
    }

    public function evaluate(Quiz $quiz, array $submittedAnswers): Attempt
    {
        /*
        Create attempt
        */

        $attempt = Attempt::create([
            'quiz_id' => $quiz->id,
            'total_score' => 0,
        ]);

        $totalScore = 0;

        /*
        Loop through all quiz questions
        */

        foreach ($quiz->questions as $question) {

            $answer = $submittedAnswers[$question->id] ?? null;

            /*
            Resolve handler dynamically
            */

            $handler = $this->handlerService
                            ->resolve($question->type);

            /*
            Validate answer
            */

            $isValid = $handler->validateAnswer($answer);

            if (!$isValid) {

                $isCorrect = false;
                $marks = 0;

            } else {

                /*
                Check correctness
                */

                $isCorrect = $handler->isCorrect(
                    $question,
                    $answer
                );

                /*
                Calculate marks
                */

                $marks = $handler->calculateMarks(
                    $question,
                    $answer
                );
            }

            /*
            Store answer
            */

            Answer::create([

                'attempt_id' => $attempt->id,

                'question_id' => $question->id,

                'answer' => is_array($answer)
                    ? json_encode($answer)
                    : $answer,

                'is_correct' => $isCorrect,

                'obtained_marks' => $marks,
            ]);

            $totalScore += $marks;
        }

        /*
        Update total score
        */

        $attempt->update([
            'total_score' => $totalScore
        ]);

        return $attempt;
    }
}