<?php

namespace App\Contracts;

use App\Models\Question;

interface QuestionTypeInterface
{
    public function validateAnswer($answer): bool;

    public function isCorrect(Question $question, $answer): bool;

    public function calculateMarks(Question $question, $answer): float;
}