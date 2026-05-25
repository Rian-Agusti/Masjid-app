@extends('layouts.app')

@section('title', 'Edit Jadwal Jumat')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Edit Jadwal Jumat</h2>
        <form action="{{ route('admin.jadwal-jumat.update', $jadwal_jumat) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.jadwal-jumat.form')
        </form>
    </div>
@endsection