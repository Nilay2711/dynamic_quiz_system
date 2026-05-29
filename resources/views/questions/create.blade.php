@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">

        <h4>
            Add Question
            <small class="text-muted">
                ({{ $quiz->title }})
            </small>
        </h4>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('questions.store', $quiz->id) }}"
              enctype="multipart/form-data">

            @csrf

            <!-- Question Type -->

            <div class="mb-3">

                <label class="form-label">
                    Question Type
                </label>

                <select name="type"
                        id="questionType"
                        class="form-select"
                        required>

                    <option value="">
                        Select Type
                    </option>

                    <option value="binary">
                        Binary
                    </option>

                    <option value="single_choice">
                        Single Choice
                    </option>

                    <option value="multiple_choice">
                        Multiple Choice
                    </option>

                    <option value="number">
                        Number
                    </option>

                    <option value="text">
                        Text
                    </option>

                </select>

            </div>

            <!-- Question -->

            <div class="mb-3">

                <label class="form-label">
                    Question
                </label>

                <textarea name="question"
          class="form-control"
          rows="4"
          required>{{ old('question') }}</textarea>

            </div>

            <!-- Marks -->

            <div class="mb-3">

                <label class="form-label">
                    Marks
                </label>

                <input type="number"
       name="marks"
       class="form-control"
       value="{{ old('marks', 1) }}"
       min="1">

            </div>

            <!-- Correct Answer -->

            <div class="mb-3"
                 id="correctAnswerContainer">

                <label class="form-label">
                    Correct Answer
                </label>

                <input type="text"
       name="correct_answer"
       class="form-control"
       value="{{ old('correct_answer') }}">

            </div>

            <!-- Options -->

            <div id="optionsContainer"
                 style="display:none;">

                <hr>

                <h5>Options</h5>

                <div id="optionsWrapper"></div>

                <button type="button"
                        class="btn btn-secondary btn-sm mt-2"
                        id="addOptionBtn">

                    Add Option

                </button>

            </div>

            <!-- Image -->

            <div class="mb-3 mt-4">

                <label class="form-label">
                    Question Image
                </label>

                <input type="file"
                       name="image"
                       class="form-control">

            </div>

            <!-- Video URL -->

            <div class="mb-3">

                <label class="form-label">
                    Video URL
                </label>

                <input type="url"
       name="video_url"
       class="form-control"
       value="{{ old('video_url') }}">

            </div>

            <button class="btn btn-success">

                Save Question

            </button>

        </form>

    </div>

</div>

@endsection

