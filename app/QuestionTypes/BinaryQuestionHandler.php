<?php

namespace App\QuestionTypes;

use App\Models\Question;

class BinaryQuestionHandler extends BaseQuestionHandler
{
    public function validateAnswer($answer): bool
    {
        return in_array($answer, ['yes', 'no']);
    }

    public function isCorrect(Question $question, $answer): bool
    {
        return strtolower($question->correct_answer)
            === strtolower($answer);
    }
}