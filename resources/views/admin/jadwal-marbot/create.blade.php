@extends('layouts.app')

@section('title', 'Tambah Jadwal Marbot')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Tambah Jadwal Marbot</h2>
        <form action="{{ route('admin.jadwal-marbot.store') }}" method="POST">
            @include('admin.jadwal-marbot.form')
        </form>
    </div>
@endsection