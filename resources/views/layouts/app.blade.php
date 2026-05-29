<!DOCTYPE html>
<html>

<head>

    <title>Dynamic Quiz System</title>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container">

        <a href="{{ route('quizzes.index') }}"
           class="navbar-brand fw-bold">

            Dynamic Quiz System

        </a>

        <div class="ms-auto">

            <a href="{{ route('quizzes.index') }}"
               class="btn btn-outline-light btn-sm me-2">

                Dashboard

            </a>

            <a href="{{ route('quizzes.create') }}"
               class="btn btn-primary btn-sm">

                Create Quiz

            </a>

        </div>

    </div>

</nav>

<div class="container py-4">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if ($errors->any())

    <div class="alert alert-danger">

        <strong>

            Please fix the following errors:

        </strong>

        <ul class="mb-0 mt-2">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

    @yield('content')

</div>
@yield('scripts')
</body>

</html>