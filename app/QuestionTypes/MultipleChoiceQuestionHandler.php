<?php

namespace App\QuestionTypes;

use App\Models\Question;

class MultipleChoiceQuestionHandler extends BaseQuestionHandler
{
    public function validateAnswer($answer): bool
    {
        return is_array($answer);
    }

    public function isCorrect(Question $question, $answer): bool
    {
        $correctOptionIds = $question->options()
            ->where('is_correct', true)
            ->pluck('id')
            ->toArray();

        sort($correctOptionIds);
        sort($answer);

        return $correctOptionIds == $answer;
    }
}