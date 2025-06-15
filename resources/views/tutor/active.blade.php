@extends('layouts.dashboard')

@section('placeholder')
    Cari tutor aktif terkini...
@endsection

@section('content')
    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h1 class="text-2xl font-bold mb-1.5">Active Tutors</h1>
            <p class="opacity-70">Lihat tutor aktif di platform.</p>
        </div>
    </div>

    @if (session('success'))
        @foreach ((array) session('success') as $message)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-6 mb-2">
                {{ $message }}
            </div>
        @endforeach
    @endif
    
    <div class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm mt-8">
        @forelse ($tutors as $tutor)
            <div
                class="flex flex-col md:flex-row items-start md:items-center w-full justify-between p-6 gap-6 border-b border-gray-200 last:border-b-0">
                <!-- Tutor Info Section -->
                <div class="flex items-start gap-4 w-full md:w-auto">
                    <img src="{{ asset('assets/images/icons/user.svg') }}" alt="User Icon"
                        class="w-16 h-16 rounded-full flex-shrink-0">

                    <div class="flex-1 min-w-0">
                        <h1 class="text-xl font-semibold text-gray-800 break-words">{{ $tutor->user->name }}</h1>

                        <!-- Social Links Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mt-4">
                            <!-- GitHub -->
                            @if ($tutor->github_url)
                                <div
                                    class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <img src="{{ asset('assets/images/icons/github.svg') }}" alt="GitHub Icon"
                                        class="w-5 h-5 flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-700 truncate">GitHub</p>
                                        <a href="{{ $tutor->github_url }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 hover:underline text-xs flex items-center">
                                            Buka profil
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- LinkedIn -->
                            @if ($tutor->linkedin_url)
                                <div
                                    class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <img src="{{ asset('assets/images/icons/linkedin.svg') }}" alt="LinkedIn Icon"
                                        class="w-5 h-5 flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-700 truncate">LinkedIn</p>
                                        <a href="{{ $tutor->linkedin_url }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 hover:underline text-xs flex items-center">
                                            Buka profil
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Portfolio -->
                            @if ($tutor->portofolio)
                                <div
                                    class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <img src="{{ asset('assets/images/icons/portfolio.svg') }}" alt="Portfolio Icon"
                                        class="w-5 h-5 flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-700 truncate">Portofolio</p>
                                        <a href="{{ asset('storage/' . $tutor->portofolio) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 hover:underline text-xs flex items-center">
                                            Lihat PDF
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="p-8">Belum ada tutor yang aktif.</p>
        @endforelse
    </div>
@endsection