@extends('layouts.dashboard')

@section('head-content')
    <div class="relative mb-6">
        <input type="text" id="search-course" placeholder="Cari nama course..."
            class="w-full pl-10 pr-4 py-2 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary transition" />
        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
    </div>
@endsection

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div class="flex flex-col">
            <h1 class="text-2xl font-bold mb-1.5">Active Courses</h1>
            <p class="opacity-70">Lihat seluruh kursus aktif di platform.</p>
        </div>
    </div>

    @if (session('success'))
        @foreach ((array) session('success') as $message)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-6 mb-2">
                {{ $message }}
            </div>
        @endforeach
    @endif

    <div id="course-list" class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm">
        @forelse ($activeCourses as $course)
            <div class="flex items-center w-full justify-between p-8 gap-4 border-b border-gray-200">
                <div class="flex items-center gap-4">
                    @if ($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                            class="w-30 h-20 rounded-xl object-cover border-2 border-gray-300">
                    @else
                        <img src="{{ asset('storage/default-placeholder.png') }}" alt="Preview"
                            class="w-30 h-20 rounded-xl object-cover border-2 border-gray-300" />
                    @endif
                    <div class="flex flex-col w-full max-w-xs">
                        <h1 class="text-xl font-semibold break-words text-left">{{ $course->name }}</h1>
                        <p class="text-font text-left opacity-70">{{ $course->category->name ?? 'Kategori' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.course.show', $course->id) }}"
                        class="flex items-center px-6 py-3 text-white bg-font rounded-full hover:opacity-90 transition-colors">
                        <span class="font-medium">Detail</span>
                    </a>
                </div>
            </div>
        @empty
            <p class="p-8">Belum ada course yang dipublish.</p>
        @endforelse
    </div>
    <script src="{{ asset('js/admin-course-active-search.js') }}"></script>
@endsection