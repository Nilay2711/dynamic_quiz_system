<?php

namespace App\Services;

use Exception;

use App\Contracts\QuestionTypeInterface;

use App\QuestionTypes\BinaryQuestionHandler;
use App\QuestionTypes\NumberQuestionHandler;
use App\QuestionTypes\TextQuestionHandler;
use App\QuestionTypes\SingleChoiceQuestionHandler;
use App\QuestionTypes\MultipleChoiceQuestionHandler;

class QuestionHandlerService
{
    public function resolve(string $type): QuestionTypeInterface
    {
        return match ($type) {

            'binary' => new BinaryQuestionHandler(),

            'number' => new NumberQuestionHandler(),

            'text' => new TextQuestionHandler(),

            'single_choice' => new SingleChoiceQuestionHandler(),

            'multiple_choice' => new MultipleChoiceQuestionHandler(),

            default => throw new Exception("Unsupported question type: {$type}")
        };
    }
}