<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div {{ $attributes->merge(['class' => 'bg-slate-800 rounded-lg shadow-md p-6']) }}>
        <h3 class="text-lg font-semibold text-slate-100">{{ $title }}</h3>
        <p class="text-emerald-400 text-2xl font-bold mt-2">{{ $value }}</p>
        <p class="text-slate-400 text-sm">{{ $subtitle }}</p>
    </div>

</body>

</html>