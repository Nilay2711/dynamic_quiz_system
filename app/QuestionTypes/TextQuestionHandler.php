<?php

namespace App\QuestionTypes;

use App\Models\Question;

class TextQuestionHandler extends BaseQuestionHandler
{
    public function validateAnswer($answer): bool
    {
        return !empty(trim($answer));
    }

    public function isCorrect(Question $question, $answer): bool
    {
        return strtolower(trim($question->correct_answer))
            === strtolower(trim($answer));
    }
}