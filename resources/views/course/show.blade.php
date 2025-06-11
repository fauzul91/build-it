@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold mb-1.5">{{ $course->name }}</h1>
            <a href="{{ route('video.preview', ['course' => $course->id]) }}"
                class="px-6 py-3 bg-white text-font rounded-full hover:shadow-md transition-colors">
                <span class="font-medium">Preview</span>
            </a>
        </div>

        <div class="grid grid-cols-1 w-2/3 gap-8 mb-4">
            <div class="bg-white rounded-xl shadow-sm p-8">
                {{-- Overview Course --}}
                <div class="flex items-center justify-between">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                        class="w-80 h-40 rounded-xl border border-gray-300 object-cover">
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col p-5 rounded-xl shadow-sm gap-2">
                            <h2 class="text-md font-semibold">Course Category</h2>
                            <p class="text-gray-500">{{ $course->category->name ?? 'Kategori' }}</p>
                        </div>
                        <div class="flex flex-col p-5 rounded-xl shadow-sm gap-2">
                            <h2 class="text-md font-semibold">Total Student</h2>
                            <p class="text-gray-500">0 Student</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Course Content --}}
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Course Content</h2>
            @if ($course->status == 'draft')
                <a href="{{ route('courses.videos.create', $course->id) }}"
                    class="px-6 py-3 bg-primary text-white rounded-full hover:opacity-90 transition-colors">
                    <span class="font-medium">New Content</span>
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 mt-4 w-2/3">
            @forelse($course->videos as $video)
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-md font-normal mb-4">{{ $video->title }}</h2>
                    <div class="mt-1">
                        <div class="flex items-center gap-2">
                            @if ($video->status == 'draft')
                                <a href="{{ route('courses.videos.edit', [$course->id, $video->id]) }}"
                                    class="px-6 py-3 rounded-full cursor-pointer hover:opacity-90 bg-primary text-white">Edit</a>
                                <form action="{{ route('courses.videos.destroy', [$course->id, $video->id]) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-6 py-3 rounded-full cursor-pointer hover:opacity-90 bg-red-500 text-white">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <li>Belum ada video.</li>
            @endforelse
        </div>
    </div>
@endsection
