<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body>

    {{-- <h1>Welcome, {{ $name }} </h1> --}}

    @php
        $isActive = true;
        $hasError = false;
    @endphp

    <span @class([
        'p-4',
        'font-bold' => $isActive,
        'text-gray-500' => !$isActive,
        'bg-red-600' => $hasError,
    ])>Welcome, User </span>

    <div>
        <span @style([
            'background-color: red' => !$isActive,
            'background-color: green' => $isActive,
            'font-weight: bold' => $isActive,
        ])>Some conditional style</span>
    </div>







    {{-- <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
    </div> --}}

</body>

</html>
