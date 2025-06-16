@extends('layouts.app')

@section('title', 'Student Panel')

@section('content')
    <div class="flex w-full min-h-screen bg-gray-50">
        <aside class="w-64 px-6 py-8 bg-white shadow-md sticky top-0 h-screen">
            <div class="text-center mb-10">
                @if (auth()->user()->photo)
                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="avatar"
                        class="w-20 h-20 mx-auto rounded-full object-cover">
                @else
                    <img src="{{ asset('assets\images\icons\profile-user.jpeg') }}" alt="avatar"
                        class="w-20 h-20 mx-auto rounded-full object-cover">
                @endif
                <h2 class="mt-4 text-lg font-semibold">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-gray-500">{{ ucfirst(auth()->user()->getRoleNames()->first()) }}</p>
            </div>

            <nav class="space-y-4">
                <a href="{{ route('student.course') }}"
                    class="flex items-center gap-3 text-gray-600 hover:text-blue-600 {{ request()->is('student/courses') ? 'text-blue-600 font-semibold' : '' }}">
                    <i class="ri-stack-line text-lg"></i> My Courses
                </a>
                <a href="{{ route('student.transaction') }}"
                    class="flex items-center gap-3 text-gray-600 hover:text-blue-600 {{ request()->is('student/transactions') ? 'text-blue-600 font-semibold' : '' }}">
                    <i class="ri-file-list-line text-lg"></i> Transactions
                </a>
                <a href="{{ route('student.profile') }}"
                    class="flex items-center gap-3 text-gray-600 hover:text-blue-600 {{ request()->is('student/profile') ? 'text-blue-600 font-semibold' : '' }}">
                    <i class="ri-settings-3-line text-lg"></i> Settings
                </a>
            </nav>
        </aside>

        <main class="flex-1 px-10 py-10 overflow-hidden">
            @yield('student-content')
        </main>
    </div>
@endsection
