@extends('layouts.app')

@section('title', 'Tambah Jadwal Jumat')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Tambah Jadwal Jumat</h2>
        <form action="{{ route('admin.jadwal-jumat.store') }}" method="POST">
            @include('admin.jadwal-jumat.form')
        </form>
    </div>
@endsection