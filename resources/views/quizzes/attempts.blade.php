@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>

            Attempt History

        </h2>

        <p class="text-muted mb-0">

            {{ $quiz->title }}

        </p>

    </div>

    <a href="{{ route('quizzes.index') }}"
       class="btn btn-secondary">

        Back

    </a>

</div>

@if($attempts->count())

    <div class="card">

        <div class="table-responsive">

            <table class="table table-bordered mb-0">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Score</th>

                        <th>Date</th>

                        <th width="150">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($attempts as $attempt)

                        @php

                            $totalMarks =
                                $attempt
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

                        @endphp

                        <tr>

                            <td>

                                #{{ $attempt->id }}

                            </td>

                            <td>

                                {{ $attempt->total_score }}
                                /
                                {{ $totalMarks }}

                                <br>

                                <small class="text-muted">

                                    {{ $percentage }}%

                                </small>

                            </td>

                            <td>

                                {{ $attempt->created_at->format('d M Y h:i A') }}

                            </td>

                            <td>

                                <a href="{{ route('attempts.result', $attempt->id) }}"
                                   class="btn btn-sm btn-primary">

                                    View Result

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

        No quiz attempts found yet.

    </div>

@endif

@endsection