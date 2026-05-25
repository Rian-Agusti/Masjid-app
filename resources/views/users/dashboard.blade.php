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
    @extends('layouts.app')

    @section('title', 'User Dashboard')

    @section('content')
        <h2 class="text-xl font-semibold mb-4">User Dashboard</h2>
        <div class="bg-slate-800 p-4 rounded text-slate-200">
            <p>Selamat datang, {{ auth()->user()->name }}!</p>
            <p>Email: {{ auth()->user()->email }}</p>
            <p>Role: {{ auth()->user()->role }}</p>
        </div>
    @endsection


</body>

</html>