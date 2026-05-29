@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">

        <h4>Create Quiz</h4>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('quizzes.store') }}">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Quiz Title

                </label>

                <input type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Description

                </label>

                <textarea name="description"
          class="form-control"
          rows="4">{{ old('description') }}</textarea>

            </div>

            <button class="btn btn-success">

                Save Quiz

            </button>

        </form>

    </div>

</div>

@endsection

