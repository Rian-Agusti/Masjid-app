<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="bg-slate-800 border-b border-slate-700 px-4 py-3 flex items-center justify-between">
        <h1 class="text-lg font-semibold text-slate-100">
            @auth
                {{ auth()->user()->role }}
            @else
                Guest
            @endauth
        </h1>

        <div class="flex items-center gap-4">
            @auth
                <span class="hidden sm:inline text-sm text-slate-300">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-slate-300 hover:text-white">Masuk</a>
                <a href="{{ route('register') }}"
                    class="text-sm bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded">
                    Daftar
                </a>
            @endauth
        </div>
    </nav>
</body>

</html>