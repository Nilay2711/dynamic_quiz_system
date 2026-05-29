@extends('layouts.app')

@section('content')

<h2 class="mb-4">

    {{ $quiz->title }}

</h2>

<p class="text-muted">

    {{ $quiz->description }}

</p>

<form method="POST"
      action="{{ route('quizzes.submit', $quiz->id) }}">

    @csrf

    @foreach($quiz->questions as $question)

        <div class="card mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <h5>

                        Q{{ $loop->iteration }}.
                        {!! $question->question !!}

                    </h5>

                    <strong>

                        {{ $question->marks }} Marks

                    </strong>

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

                <!-- Answer Inputs -->

                <div class="mt-4">

                    <!-- Binary -->

                    @if($question->type === 'binary')

                        <select name="answers[{{ $question->id }}]"
                                class="form-select">

                            <option value="">
                                Select
                            </option>

                            <option value="yes">
                                Yes
                            </option>

                            <option value="no">
                                No
                            </option>

                        </select>

                    <!-- Single Choice -->

                    @elseif($question->type === 'single_choice')

                        @foreach($question->options as $option)

                            <div class="form-check">

                                <input class="form-check-input"
                                       type="radio"
                                       name="answers[{{ $question->id }}]"
                                       value="{{ $option->id }}">

                                <label class="form-check-label">

                                    {{ $option->option_text }}

                                </label>

                            </div>

                        @endforeach

                    <!-- Multiple Choice -->

                    @elseif($question->type === 'multiple_choice')

                        @foreach($question->options as $option)

                            <div class="form-check">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="answers[{{ $question->id }}][]"
                                       value="{{ $option->id }}">

                                <label class="form-check-label">

                                    {{ $option->option_text }}

                                </label>

                            </div>

                        @endforeach

                    <!-- Number -->

                    @elseif($question->type === 'number')

                        <input type="number"
                               name="answers[{{ $question->id }}]"
                               class="form-control">

                    <!-- Text -->

                    @elseif($question->type === 'text')

                        <textarea name="answers[{{ $question->id }}]"
                                  class="form-control"
                                  rows="3"></textarea>

                    @endif

                </div>

            </div>

        </div>

    @endforeach

    <button class="btn btn-success btn-lg">

        Submit Quiz

    </button>

</form>

@endsection


