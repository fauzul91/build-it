@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <div class="flex flex-col mb-8">
        <h1 class="text-2xl font-bold mb-1.5">Manage Courses</h1>
        <p class="opacity-70">Atur seluruh kursus aktif di platform.</p>
    </div>

    <div class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm">
        @forelse ($tutorStatusCourses as $course)
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

                    <span
                        class="px-6 py-3 rounded-full text-white text-sm font-medium
                        @if ($course->status === 'approved') bg-green-500
                        @elseif ($course->status === 'pending') bg-yellow-500
                        @elseif ($course->status === 'rejected') bg-red-500
                        @else bg-gray-500 @endif">
                        {{ ucfirst($course->status) }}
                    </span>

                    @if ($course->status === 'rejected')
                        <a href="{{ route('courses.edit', $course->id) }}"
                            class="flex items-center px-6 py-3 text-white bg-yellow-500 rounded-full hover:opacity-90 transition-colors">
                            <span class="font-medium">Edit</span>
                        </a>
                    @endif
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
