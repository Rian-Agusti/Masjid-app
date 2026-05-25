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

    @section('title', 'Users')

    @section('content')
        <h2 class="text-xl font-semibold mb-4">Users</h2>
        <table class="min-w-full bg-slate-800 border border-slate-700 rounded">
            <thead class="bg-slate-700 text-slate-200">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Created At</th>
                    <th class="px-4 py-2 text-left">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t border-slate-700">
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->created_at }}</td>
                        <td class="px-4 py-2">{{ $user->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection

</body>

</html>