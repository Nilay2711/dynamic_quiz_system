<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Quiz;

class QuizController extends Controller
{
    /*
    Show all quizzes
    */
    public function index()
    {
        // $quizzes = Quiz::latest()->get();
        $quizzes = Quiz::with('questions')->latest()->get();

        $totalQuizzes = \App\Models\Quiz::count();

$totalQuestions = \App\Models\Question::count();

$totalAttempts = \App\Models\Attempt::count();

return view(
    'quizzes.index',
    compact(
        'quizzes',
        'totalQuizzes',
        'totalQuestions',
        'totalAttempts'
    )
);
    }

    /*
    Show create form
    */
    public function create()
    {
        return view('quizzes.create');
    }

    /*
    Store new quiz
    */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => 'required|max:255',

            'description' => 'nullable',
        ]);

        Quiz::create($validated);

        return redirect()
            ->route('quizzes.index')
            ->with('success', 'Quiz created successfully.');
    }

    /*
|--------------------------------------------------------------------------
| Show Question Form
|--------------------------------------------------------------------------
*/

public function createQuestion(Quiz $quiz)
{
    return view('questions.create', compact('quiz'));
}

/*
|--------------------------------------------------------------------------
| Store Question
|--------------------------------------------------------------------------
*/

public function storeQuestion(Request $request, Quiz $quiz)
{
    $validated = $request->validate([

        'type' => 'required',

        'question' => 'required',

        'marks' => 'required|numeric|min:1',

        'correct_answer' => 'nullable',

        'image' => 'nullable|image',

        'video_url' => 'nullable|url',

        'options' => 'nullable|array|min:2',
    ]);

    /*
|--------------------------------------------------------------------------
| Custom MCQ Validation
|--------------------------------------------------------------------------
*/

if (
    in_array(
        $validated['type'],
        ['single_choice', 'multiple_choice']
    )
) {

    /*
    Must have options
    */

    if (empty($validated['options'])) {

        return back()
            ->withErrors([
                'options' =>
                    'At least 2 options are required.'
            ])
            ->withInput();
    }

    /*
    Single Choice
    */

    if (
        $validated['type'] === 'single_choice' &&
        !$request->has('correct_option')
    ) {

        return back()
            ->withErrors([
                'correct_option' =>
                    'Please select the correct option.'
            ])
            ->withInput();
    }

    /*
    Multiple Choice
    */

    if (
        $validated['type'] === 'multiple_choice'
    ) {

        $hasCorrect = false;

        foreach ($validated['options'] as $option) {

            if (isset($option['is_correct'])) {

                $hasCorrect = true;
                break;
            }
        }

        if (!$hasCorrect) {

            return back()
                ->withErrors([
                    'options' =>
                        'Please select at least one correct option.'
                ])
                ->withInput();
        }
    }
}

    /*
    Upload image if exists
    */

    $imagePath = null;

    if ($request->hasFile('image')) {

        $imagePath = $request->file('image')
            ->store('questions', 'public');
    }

    /*
    Create question
    */

    $question = $quiz->questions()->create([

        'type' => $validated['type'],

        'question' => $validated['question'],

        'marks' => $validated['marks'],

        'correct_answer' => $validated['correct_answer'] ?? null,

        'image' => $imagePath,

        'video_url' => $validated['video_url'] ?? null,
    ]);

    /*
    Save options if provided
    */

    if (!empty($validated['options'])) {

        foreach ($validated['options'] as $index => $option) {

    $isCorrect = false;

    if ($validated['type'] === 'single_choice') {

        $isCorrect =
            $request->correct_option == $index;

    } elseif ($validated['type'] === 'multiple_choice') {

        $isCorrect =
            isset($option['is_correct']);
    }

    $question->options()->create([

        'option_text' => $option['text'],

        'is_correct' => $isCorrect,
    ]);
}
    }

    return redirect()
        ->route('quizzes.index')
        ->with('success', 'Question added successfully.');
}

/*
|--------------------------------------------------------------------------
| Show Quiz Details
|--------------------------------------------------------------------------
*/

public function show(Quiz $quiz)
{
    $quiz->load('questions.options');

    return view('quizzes.show', compact('quiz'));
}

/*
|--------------------------------------------------------------------------
| Attempt Quiz
|--------------------------------------------------------------------------
*/

public function attempt(Quiz $quiz)
{
    $quiz->load('questions.options');

    return view('quizzes.attempt', compact('quiz'));
}

/*
|--------------------------------------------------------------------------
| Submit Quiz Attempt
|--------------------------------------------------------------------------
*/

public function submitAttempt(
    Request $request,
    Quiz $quiz
) {

    $submittedAnswers = $request->input('answers', []);

    /*
    Evaluate quiz
    */

    $evaluationService = new \App\Services\QuizEvaluationService();

    $attempt = $evaluationService->evaluate(
        $quiz,
        $submittedAnswers
    );

    return redirect()
        ->route('attempts.result', $attempt->id);
}

/*
|--------------------------------------------------------------------------
| Show Result
|--------------------------------------------------------------------------
*/

public function result(
    \App\Models\Attempt $attempt
) {

    $attempt->load(
        'quiz',
        'answers.question.options'
    );

    $totalMarks = $attempt
    ->quiz
    ->questions
    ->sum('marks');

$percentage =
    $totalMarks > 0
        ? round(
            ($attempt->total_score / $totalMarks) * 100,
            2
        )
        : 0;

$status =
    $percentage >= 40
        ? 'PASS'
        : 'FAIL';

return view(
    'quizzes.result',
    compact(
        'attempt',
        'totalMarks',
        'percentage',
        'status'
    )
);
}

/*
|--------------------------------------------------------------------------
| Delete Question
|--------------------------------------------------------------------------
*/

public function deleteQuestion(
    \App\Models\Question $question
) {

    /*
    Delete options first
    */

    $question->options()->delete();

    /*
    Delete image if exists
    */

    if ($question->image) {

        Storage::disk('public')
            ->delete($question->image);
    }

    /*
    Delete question
    */

    $question->delete();

    return redirect()
        ->back()
        ->with(
            'success',
            'Question deleted successfully.'
        );
}

/*
|--------------------------------------------------------------------------
| Edit Question
|--------------------------------------------------------------------------
*/

public function editQuestion(
    \App\Models\Question $question
) {

    $question->load('options');

    return view(
        'questions.edit',
        compact('question')
    );
}

/*
|--------------------------------------------------------------------------
| Update Question
|--------------------------------------------------------------------------
*/

public function updateQuestion(
    Request $request,
    \App\Models\Question $question
) {

    $validated = $request->validate([

        'type' => 'required',

        'question' => 'required',

        'marks' => 'required|numeric|min:1',

        'correct_answer' => 'nullable',

        'image' => 'nullable|image',

        'video_url' => 'nullable|url',

        'options' => 'nullable|array|min:2',
    ]);

    /*
|--------------------------------------------------------------------------
| Custom MCQ Validation
|--------------------------------------------------------------------------
*/

if (
    in_array(
        $validated['type'],
        ['single_choice', 'multiple_choice']
    )
) {

    /*
    Must have options
    */

    if (empty($validated['options'])) {

        return back()
            ->withErrors([
                'options' =>
                    'At least 2 options are required.'
            ])
            ->withInput();
    }

    /*
    Single Choice
    */

    if (
        $validated['type'] === 'single_choice' &&
        !$request->has('correct_option')
    ) {

        return back()
            ->withErrors([
                'correct_option' =>
                    'Please select the correct option.'
            ])
            ->withInput();
    }

    /*
    Multiple Choice
    */

    if (
        $validated['type'] === 'multiple_choice'
    ) {

        $hasCorrect = false;

        foreach ($validated['options'] as $option) {

            if (isset($option['is_correct'])) {

                $hasCorrect = true;
                break;
            }
        }

        if (!$hasCorrect) {

            return back()
                ->withErrors([
                    'options' =>
                        'Please select at least one correct option.'
                ])
                ->withInput();
        }
    }
}

    /*
    Upload new image
    */

    if ($request->hasFile('image')) {

        /*
        Delete old image
        */

        if ($question->image) {

            Storage::disk('public')
                ->delete($question->image);
        }

        $question->image = $request
            ->file('image')
            ->store('questions', 'public');
    }

    /*
    Update question
    */

    $question->update([

        'type' => $validated['type'],

        'question' => $validated['question'],

        'marks' => $validated['marks'],

        'correct_answer' =>
            $validated['correct_answer'] ?? null,

        'video_url' =>
            $validated['video_url'] ?? null,
    ]);

    /*
    Replace options completely
    */

    $question->options()->delete();

    if (!empty($validated['options'])) {

        foreach ($validated['options'] as $index => $option) {

    $isCorrect = false;

    if ($validated['type'] === 'single_choice') {

        $isCorrect =
            $request->correct_option == $index;

    } elseif ($validated['type'] === 'multiple_choice') {

        $isCorrect =
            isset($option['is_correct']);
    }

    $question->options()->create([

        'option_text' => $option['text'],

        'is_correct' => $isCorrect,
    ]);
}
    }

    return redirect()
        ->route('quizzes.show', $question->quiz_id)
        ->with(
            'success',
            'Question updated successfully.'
        );
}

/*
|--------------------------------------------------------------------------
| Attempt History
|--------------------------------------------------------------------------
*/

public function attemptHistory(
    \App\Models\Quiz $quiz
) {

    $attempts = $quiz
        ->attempts()
        ->with('answers', 'quiz')
        ->latest()
        ->get();

    return view(
        'quizzes.attempts',
        compact(
            'quiz',
            'attempts'
        )
    );
}

/*
|--------------------------------------------------------------------------
| Delete Quiz
|--------------------------------------------------------------------------
*/

public function destroy(
    \App\Models\Quiz $quiz
) {

    /*
    Delete question images
    */

    foreach ($quiz->questions as $question) {

        if ($question->image) {

            Storage::disk('public')
                ->delete($question->image);
        }

        /*
        Delete options
        */

        $question->options()->delete();
    }

    /*
    Delete answers
    */

    foreach ($quiz->attempts as $attempt) {

        $attempt->answers()->delete();
    }

    /*
    Delete attempts
    */

    $quiz->attempts()->delete();

    /*
    Delete questions
    */

    $quiz->questions()->delete();

    /*
    Delete quiz
    */

    $quiz->delete();

    return redirect()
        ->route('quizzes.index')
        ->with(
            'success',
            'Quiz deleted successfully.'
        );
}
}