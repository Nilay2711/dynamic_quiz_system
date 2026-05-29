@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">

        <h4>Edit Question</h4>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('questions.update', $question->id) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Question Type -->

            <div class="mb-3">

                <label class="form-label">

                    Question Type

                </label>

                <select name="type"
                        id="questionType"
                        class="form-select"
                        required>

                    <option value="binary"
                        {{ $question->type == 'binary' ? 'selected' : '' }}>

                        Binary

                    </option>

                    <option value="single_choice"
                        {{ $question->type == 'single_choice' ? 'selected' : '' }}>

                        Single Choice

                    </option>

                    <option value="multiple_choice"
                        {{ $question->type == 'multiple_choice' ? 'selected' : '' }}>

                        Multiple Choice

                    </option>

                    <option value="number"
                        {{ $question->type == 'number' ? 'selected' : '' }}>

                        Number

                    </option>

                    <option value="text"
                        {{ $question->type == 'text' ? 'selected' : '' }}>

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
                          required>{{ $question->question }}</textarea>

            </div>

            <!-- Marks -->

            <div class="mb-3">

                <label class="form-label">

                    Marks

                </label>

                <input type="number"
                       name="marks"
                       class="form-control"
                       value="{{ $question->marks }}"
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
                       value="{{ $question->correct_answer }}">

            </div>

            <!-- Options -->

            <div id="optionsContainer">

                <hr>

                <h5>Options</h5>

                <div id="optionsWrapper">

                    @foreach($question->options as $index => $option)

                        <div class="card p-3 mb-3 option-item">

                            <div class="row align-items-center">

                                <div class="col-md-8">

                                    <input type="text"
                                           name="options[{{ $index }}][text]"
                                           class="form-control"
                                           value="{{ $option->option_text }}"
                                           required>

                                </div>

                                <div class="col-md-2">

                                    <div class="form-check">

                                        <input class="form-check-input"
                                               type="{{ $question->type == 'multiple_choice' ? 'checkbox' : 'radio' }}"
                                               name="options[{{ $index }}][is_correct]"
                                               {{ $option->is_correct ? 'checked' : '' }}>

                                        <label class="form-check-label">

                                            Correct

                                        </label>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <button type="button"
                                            class="btn btn-danger btn-sm removeOptionBtn">

                                        Remove

                                    </button>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                <button type="button"
                        class="btn btn-secondary btn-sm mt-2"
                        id="addOptionBtn">

                    Add Option

                </button>

            </div>

            <!-- Current Image -->

            @if($question->image)

                <div class="mb-3">

                    <img src="{{ asset('storage/' . $question->image) }}"
                         class="img-fluid rounded"
                         style="max-height:200px;">

                </div>

            @endif

            <!-- Upload New Image -->

            <div class="mb-3">

                <label class="form-label">

                    Change Image

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
                       value="{{ $question->video_url }}">

            </div>

            <button class="btn btn-success">

                Update Question

            </button>

        </form>

    </div>

</div>

@endsection