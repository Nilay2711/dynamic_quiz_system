<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return redirect('/quizzes');
});

Route::get('/quizzes', [QuizController::class, 'index'])
    ->name('quizzes.index');

Route::get('/quizzes/create', [QuizController::class, 'create'])
    ->name('quizzes.create');

Route::post('/quizzes', [QuizController::class, 'store'])
    ->name('quizzes.store');



Route::get('/quizzes/{quiz}/questions/create',
    [QuizController::class, 'createQuestion'])
    ->name('questions.create');

Route::post('/quizzes/{quiz}/questions',
    [QuizController::class, 'storeQuestion'])
    ->name('questions.store');

Route::get('/quizzes/{quiz}',
    [QuizController::class, 'show'])
    ->name('quizzes.show');

    /*
|--------------------------------------------------------------------------
| Quiz Attempt
|--------------------------------------------------------------------------
*/

Route::get('/quizzes/{quiz}/attempt',
    [QuizController::class, 'attempt'])
    ->name('quizzes.attempt');

Route::post('/quizzes/{quiz}/submit',
    [QuizController::class, 'submitAttempt'])
    ->name('quizzes.submit');

Route::get('/attempts/{attempt}',
    [QuizController::class, 'result'])
    ->name('attempts.result');

Route::delete('/questions/{question}',
    [QuizController::class, 'deleteQuestion'])
    ->name('questions.delete');

Route::get('/questions/{question}/edit',
    [QuizController::class, 'editQuestion'])
    ->name('questions.edit');

Route::put('/questions/{question}',
    [QuizController::class, 'updateQuestion'])
    ->name('questions.update');

Route::get('/quizzes/{quiz}/attempts',
    [QuizController::class, 'attemptHistory'])
    ->name('quizzes.attempts');

Route::delete('/quizzes/{quiz}',
    [QuizController::class, 'destroy'])
    ->name('quizzes.destroy');