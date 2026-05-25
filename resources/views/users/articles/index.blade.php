@extends('layouts.app')

@section('title', 'Artikel Islami')

@section('content')
    <div class="bg-slate-900 text-slate-200 shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4">Artikel Islami</h2>

        <div class="grid gap-4">
            @forelse($articles as $article)
                <div class="p-4 border rounded hover:shadow">
                    <h3 class="text-lg font-bold">
                        <a href="{{ route('users.articles.show', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Oleh {{ $article->user->name }} • {{ $article->created_at->format('d M Y') }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada artikel.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection