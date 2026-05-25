@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-8">
            Pengumuman Masjid
        </h1>

        <div class="grid md:grid-cols-3 gap-6">

            @forelse($pengumuman as $item)

                <div class="bg-slate-900 rounded-xl shadow overflow-hidden">

                    @if($item->thumbnail)
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-5">

                        <h2 class="text-xl font-bold mb-3">
                            {{ $item->title }}
                        </h2>

                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($item->content, 100) }}
                        </p>

                        <a href="{{ route('pengumuman.show', $item->slug) }}" class="text-blue-600 font-medium">
                            Baca Selengkapnya →
                        </a>

                    </div>

                </div>

            @empty

                <div>
                    Belum ada pengumuman
                </div>

            @endforelse

        </div>

        <div class="mt-8">
            {{ $pengumuman->links() }}
        </div>

    </div>

@endsection