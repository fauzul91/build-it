@extends('layouts.app')

@section('title', 'Student Panel')

@section('content')
    <div class="flex w-[85%] justify-center mx-auto min-h-screen gap-10">
        <aside class="w-64 bg-white shadow-md rounded-2xl px-6 py-8 sticky top-35 max-h-[70vh] overflow-y-auto self-start">
            <div class="text-center mb-10">
                <img src="{{ auth()->user()->photo 
                    ? asset('storage/' . auth()->user()->photo) 
                    : asset('assets/images/icons/profile-user.jpeg') }}" 
                    alt="avatar" 
                    class="w-20 h-20 mx-auto rounded-full object-cover border-2 border-gray-200 shadow-sm">
                <h2 class="mt-4 text-lg font-semibold text-gray-800">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-gray-500 capitalize">
                    {{ auth()->user()->getRoleNames()->first() }}
                </p>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-4">
                <a href="{{ route('student.course') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md transition 
                    {{ request()->is('student/courses') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-100' }}">
                    <i class="ri-stack-line text-lg"></i> My Courses
                </a>

                <a href="{{ route('student.transaction') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md transition 
                    {{ request()->is('student/transactions') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-100' }}">
                    <i class="ri-file-list-line text-lg"></i> Transactions
                </a>

                <a href="{{ route('student.profile') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md transition 
                    {{ request()->is('student/profile') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-100' }}">
                    <i class="ri-settings-3-line text-lg"></i> Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-10 py-10">
            @yield('student-content')
        </main>
    </div>
@endsection