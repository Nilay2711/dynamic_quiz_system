<?php

namespace App\QuestionTypes;

use App\Models\Question;

class SingleChoiceQuestionHandler extends BaseQuestionHandler
{
    public function validateAnswer($answer): bool
    {
        return !empty($answer);
    }

    public function isCorrect(Question $question, $answer): bool
    {
        return $question->options()
            ->where('id', $answer)
            ->where('is_correct', true)
            ->exists();
    }
}