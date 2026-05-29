@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>{{ $quiz->title }}</h2>

        <p class="text-muted">
            {{ $quiz->description }}
        </p>

    </div>

    <a href="{{ route('questions.create', $quiz->id) }}"
       class="btn btn-primary">

        Add Question

    </a>

</div>

@if($quiz->questions->count())

    @foreach($quiz->questions as $question)

        <div class="card mb-4">

            <div class="card-body">

                <!-- Header -->

                <div class="d-flex justify-content-between">

                    <div>

                        <h5>
                            Q{{ $loop->iteration }}.
                            {!! $question->question !!}
                        </h5>

                        <span class="badge bg-secondary">

                            {{ ucfirst(str_replace('_', ' ', $question->type)) }}

                        </span>

                    </div>

                   <div class="text-end">

    <strong>

        {{ $question->marks }} Marks

    </strong>

    <br>

    <a href="{{ route('questions.edit', $question->id) }}"
   class="btn btn-sm btn-warning mb-2">

    Edit

</a>

    <form method="POST"
          action="{{ route('questions.delete', $question->id) }}"
          class="mt-2">

        @csrf
        @method('DELETE')

        <button class="btn btn-sm btn-danger"
                onclick="return confirm('Delete this question?')">

            Delete

        </button>

    </form>

</div>

                </div>

                <!-- Image -->

                @if($question->image)

                    <div class="mt-3">

                        <img src="{{ asset('storage/' . $question->image) }}"
                             class="img-fluid rounded"
                             style="max-height:300px;">

                    </div>

                @endif

                <!-- Video -->

                @if($question->video_url)

                    <div class="mt-3">

                        <a href="{{ $question->video_url }}"
                           target="_blank">

                            Watch Video

                        </a>

                    </div>

                @endif

                <!-- Options -->

                @if(
                    in_array(
                        $question->type,
                        ['single_choice', 'multiple_choice']
                    )
                )

                    <div class="mt-4">

                        <h6>Options</h6>

                        <ul class="list-group">

                            @foreach($question->options as $option)

                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    {{ $option->option_text }}

                                    @if($option->is_correct)

                                        <span class="badge bg-success">

                                            Correct

                                        </span>

                                    @endif

                                </li>

                            @endforeach

                        </ul>

                    </div>

                @else

                    <!-- Correct Answer -->

                    <div class="mt-4">

                        <strong>
                            Correct Answer:
                        </strong>

                        {{ $question->correct_answer }}

                    </div>

                @endif

            </div>

        </div>

    @endforeach

@else

    <div class="alert alert-info">

        No questions added yet.

    </div>

@endif

@endsection