@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-2xl mx-auto space-y-12">
        <!-- ==================== CARD 1: UPDATE PROFIL ==================== -->
        <div class="bg-slate-800 backdrop-blur-sm border border-slate-600 rounded-2xl shadow-xl shadow-black p-6 lg:p-8
                                            transition-all duration-300 hover:shadow-emerald-800 hover:border-slate-500">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-100">Profil Pengguna</h1>
                    <p class="text-slate-400 text-sm">Kelola informasi akun Anda</p>
                </div>
            </div>

            <!-- Alert Sukses -->
            @if(session('status'))
                <div
                    class="mb-6 p-4 bg-emerald-900 border border-emerald-700 rounded-xl flex items-center gap-3 text-emerald-300 animate-fade-in">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Form Update Profil -->
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500
                                                      focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition-all duration-200">
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500
                                                      focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition-all duration-200">
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700
                                                       text-white font-medium rounded-xl shadow-lg shadow-emerald-800
                                                       transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-emerald-600
                                                       flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- ==================== CARD 2: UPDATE PASSWORD ==================== -->
        <div class="bg-slate-800 backdrop-blur-sm border border-slate-600 rounded-2xl shadow-xl shadow-black p-6 lg:p-8
                                            transition-all duration-300 hover:shadow-emerald-800 hover:border-slate-500">
            <div class="flex items-center gap-3 mb-6">
                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h2 class="text-xl font-semibold text-slate-100">Update Password</h2>
            </div>

            <form method="POST" action="{{ route('profile.update.password') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-300 mb-1.5">Password
                        Lama</label>
                    <input type="password" name="current_password" id="current_password"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-100
                                                      focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition-all duration-200">
                    @error('current_password')
                        <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">Password Baru</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-100
                                                      focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition-all duration-200">
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1.5">Konfirmasi
                        Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-100
                                                      focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition-all duration-200">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700
                                                       text-white font-medium rounded-xl shadow-lg shadow-emerald-800
                                                       transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-emerald-600
                                                       flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endpush
