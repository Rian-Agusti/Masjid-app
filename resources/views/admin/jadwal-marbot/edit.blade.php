@extends('layouts.app')

@section('title', 'Edit Jadwal Marbot')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Edit Jadwal Marbot</h2>
        <form action="{{ route('admin.jadwal-marbot.update', $jadwal_marbot) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.jadwal-marbot.form')
        </form>
    </div>
@endsection