@extends('layouts.app')

@section('content')

<div class="card mb-4">

    <div class="card-body text-center">

        <h2 class="mb-3">

            Quiz Result

        </h2>

        <h4>

            {{ $attempt->quiz->title }}

        </h4>

        <div class="display-4 my-3">

    {{ $attempt->total_score }}
    /
    {{ $totalMarks }}

</div>

<h3 class="mb-3">

    {{ $percentage }}%

</h3>

@if($status === 'PASS')

    <span class="badge bg-success p-2">

        PASS

    </span>

@else

    <span class="badge bg-danger p-2">

        FAIL

    </span>

@endif

    </div>

</div>

<!-- Answers -->

@foreach($attempt->answers as $answer)

    @php

        $question = $answer->question;

    @endphp

    <div class="card mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between">

                <h5>

                    Q{{ $loop->iteration }}.
                    {!! $question->question !!}

                </h5>

                <div>

                    @if($answer->is_correct)

                        <span class="badge bg-success">

                            Correct

                        </span>

                    @else

                        <span class="badge bg-danger">

                            Wrong

                        </span>

                    @endif

                </div>

            </div>

            <!-- Marks -->

            <div class="mt-2">

                <strong>

                    Obtained Marks:

                </strong>

                {{ $answer->obtained_marks }}

            </div>

            <!-- Submitted Answer -->

            <div class="mt-3">

                <strong>

                    Submitted Answer:

                </strong>

                <br>

                @if(is_array(json_decode($answer->answer, true)))

                    <pre>{{ json_encode(json_decode($answer->answer), JSON_PRETTY_PRINT) }}</pre>

                @else

                    {{ $answer->answer }}
                @endif

            </div>

            <!-- Correct Answer -->

            <div class="mt-3">

                <strong>

                    Correct Answer:

                </strong>

                <br>

                @if(
                    in_array(
                        $question->type,
                        ['single_choice', 'multiple_choice']
                    )
                )

                    <ul>

                        @foreach($question->options as $option)

                            @if($option->is_correct)

                                <li>

                                    {{ $option->option_text }}

                                </li>

                            @endif

                        @endforeach

                    </ul>

                @else

                    {{ $question->correct_answer }}

                @endif

            </div>

        </div>

    </div>

@endforeach

<a href="{{ route('quizzes.index') }}"
   class="btn btn-primary">

    Back to Quizzes

</a>

@endsection