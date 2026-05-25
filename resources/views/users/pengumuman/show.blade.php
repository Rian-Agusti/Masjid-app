@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white rounded-xl shadow overflow-hidden">

            @if($pengumuman->thumbnail)
                <img src="{{ asset('storage/' . $pengumuman->thumbnail) }}" class="w-full h-80 object-cover">
            @endif

            <div class="p-8">

                <h1 class="text-3xl font-bold mb-4">
                    {{ $pengumuman->title }}
                </h1>

                <p class="text-gray-500 mb-6">
                    {{ $pengumuman->created_at->format('d M Y') }}
                </p>

                <div class="leading-8 text-gray-700">
                    {!! nl2br(e($pengumuman->content)) !!}
                </div>

            </div>

        </div>

    </div>

@endsection