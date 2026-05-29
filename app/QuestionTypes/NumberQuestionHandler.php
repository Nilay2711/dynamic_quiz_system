<?php

namespace App\QuestionTypes;

use App\Models\Question;

class NumberQuestionHandler extends BaseQuestionHandler
{
    public function validateAnswer($answer): bool
    {
        return is_numeric($answer);
    }

    public function isCorrect(Question $question, $answer): bool
    {
        return (float) $question->correct_answer
            == (float) $answer;
    }
}