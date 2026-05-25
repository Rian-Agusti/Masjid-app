@props(['title', 'value' => null, 'subtitle' => null, 'color' => 'emerald'])

@php
    $colorMap = [
        'emerald' => 'from-emerald-500 to-emerald-700',
        'indigo' => 'from-indigo-500 to-indigo-700',
        'pink' => 'from-pink-500 to-pink-700',
        'yellow' => 'from-yellow-500 to-yellow-700',
        'blue' => 'from-blue-500 to-blue-700',
        'purple' => 'from-purple-500 to-purple-700',
    ];
    $gradient = $colorMap[$color] ?? $colorMap['emerald'];
@endphp

<div
    class="bg-gradient-to-r {{ $gradient }} text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition duration-300 ease-out backdrop-blur-sm">
    <h3 class="text-lg font-semibold">{{ $title }}</h3>

    @if($value)
        <p class="text-4xl font-bold mt-2">{{ $value }}</p>
        <p class="text-sm opacity-80 mt-1">{{ $subtitle }}</p>
    @else
        <div class="animate-pulse mt-2">
            <div class="h-8 w-24 bg-white/30 rounded"></div>
            <div class="h-4 w-32 bg-white/20 rounded mt-2"></div>
        </div>
    @endif
</div>