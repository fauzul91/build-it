@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div class="flex flex-col">
            <h1 class="text-2xl font-bold mb-1.5">Manage Courses</h1>
            <p class="opacity-70">Atur seluruh kursus aktif di platform.</p>
        </div>
        <a href="{{ route('courses.create') }}"
            class="flex items-center px-6 py-3 text-white bg-primary rounded-full hover:opacity-90 transition-colors">
            <span class="font-medium">New Course</span>
        </a>
    </div>

    <div class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm">
        @forelse ($tutorDraftCourses as $course)
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

                    <form method="POST" action="{{ route('course.publish', $course->id) }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center px-6 py-3 text-font bg-white shadow-md cursor-pointer rounded-full hover:bg-gray-50 transition-colors">
                            <span class="font-medium">Publish</span>
                        </button>
                    </form>
                    <a href="{{ route('courses.edit', $course->id) }}"
                        class="flex items-center px-6 py-3 text-white bg-primary rounded-full hover:opacity-90 transition-colors">
                        <span class="font-medium">Edit</span>
                    </a>
                    <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center px-6 py-3 text-white bg-[#FF0000] rounded-full cursor-pointer hover:opacity-90 transition-colors">
                            <span class="font-medium">Delete</span>
                        </button>
                    </form>
                    <a href="{{ route('course.show', $course->id) }}"
                        class="flex items-center px-6 py-3 text-white bg-font rounded-full hover:opacity-90 transition-colors">
                        <span class="font-medium">Detail</span>
                    </a>
                </div>
            </div>
        @empty
            <p class="p-8">Tidak ada kursus yang ditampilkan. Silakan buat kursus baru.</p>
        @endforelse
    </div>
@endsection