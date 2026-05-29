@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Quizzes</h2>

    <!-- <a href="{{ route('quizzes.create') }}"
       class="btn btn-primary">

        Create Quiz

    </a> -->

</div>

<!-- Dashboard Stats -->

<div class="row mb-4">

    <div class="col-md-4">

        <div class="card text-center">

            <div class="card-body">

                <h2>{{ $totalQuizzes }}</h2>

                <p class="text-muted mb-0">

                    Total Quizzes

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-center">

            <div class="card-body">

                <h2>{{ $totalQuestions }}</h2>

                <p class="text-muted mb-0">

                    Total Questions

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-center">

            <div class="card-body">

                <h2>{{ $totalAttempts }}</h2>

                <p class="text-muted mb-0">

                    Quiz Attempts

                </p>

            </div>

        </div>

    </div>

</div>

@if($quizzes->count())

    <div class="card">

        <div class="table-responsive">

            <table class="table table-bordered mb-0">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Title</th>

                        <th>Description</th>

                        <th>Created</th>

                        <th width="450">

                            Actions

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($quizzes as $quiz)

                        <tr>

                            <td>

                                {{ $quiz->id }}

                            </td>

                            <td>

                                {{ $quiz->title }}

                            </td>

                            <td>

                                {{ $quiz->description }}

                            </td>

                            <td>

                                {{ $quiz->created_at->format('d M Y') }}

                            </td>

                            <td>

                                <a href="{{ route('quizzes.show', $quiz->id) }}"
                                   class="btn btn-sm btn-dark me-1 mb-1">

                                    View

                                </a>

                                <a href="{{ route('quizzes.attempt', $quiz->id) }}"
                                   class="btn btn-sm btn-success me-1 mb-1">

                                    Attempt

                                </a>

                                <a href="{{ route('quizzes.attempts', $quiz->id) }}"
                                    class="btn btn-sm btn-info me-1 mb-1">

                                        History

                                    </a>

                                    <form method="POST"
      action="{{ route('quizzes.destroy', $quiz->id) }}"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button class="btn btn-sm btn-danger me-1 mb-1"
            onclick="return confirm('Delete this quiz?')">

        Delete

    </button>

</form>

                                <a href="{{ route('questions.create', $quiz->id) }}"
                                   class="btn btn-sm btn-primary me-1 mb-1">

                                    Add Questions

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

@else

    <div class="alert alert-info">

        No quizzes available yet.
Create your first quiz to get started.

    </div>

@endif

@endsection