<?php

namespace App\QuestionTypes;

use App\Contracts\QuestionTypeInterface;
use App\Models\Question;

abstract class BaseQuestionHandler implements QuestionTypeInterface
{
    public function calculateMarks(Question $question, $answer): float
    {
        return $this->isCorrect($question, $answer)
            ? $question->marks
            : 0;
    }
}