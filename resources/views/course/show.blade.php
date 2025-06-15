@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-3xl font-bold mb-4">{{ $course->name }}</h1>
            @role('admin')
                <a href="{{ route('admin.course.preview', ['course' => $course->id]) }}"
                    class="px-6 py-3 bg-white text-font rounded-full hover:shadow-md transition-colors">
                    <span class="font-medium">Preview</span>
                </a>
            @else
                <a href="{{ route('tutor.course.preview', ['course' => $course->id]) }}"
                    class="px-6 py-3 bg-white text-font rounded-full hover:shadow-md transition-colors">
                    <span class="font-medium">Preview</span>
                </a>
            @endrole
        </div>

        @role('tutor')
            @if ($course->status === 'rejected' && $course->rejection_reason)
                <div class="my-6 bg-red-100 text-red-800 p-4 rounded-lg border border-red-300 w-2/3">
                    <h2 class="font-semibold text-lg mb-1">Alasan Penolakan</h2>
                    <p>{{ $course->rejection_reason }}</p>
                </div>
            @endif
        @endrole

        <div class="flex items-center gap-8 mb-4">
            <div class="flex w-full gap-8 mb-6">
                {{-- Overview Course --}}
                <div class="bg-white rounded-xl shadow-sm p-6 w-3/5 h-[360px]">
                    <div class="flex flex-col justify-center gap-5 h-full">
                        {{-- Thumbnail --}}
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                            class="w-full h-40 rounded-xl border border-gray-300 object-cover mb-4">

                        {{-- Info Box --}}
                        <div class="flex gap-4">
                            <div class="flex-1 flex flex-col p-4 rounded-xl shadow-sm bg-gray-50 gap-1">
                                <h2 class="text-sm font-semibold text-gray-700">Course Category</h2>
                                <p class="text-gray-500 text-sm">{{ $course->category->name ?? 'Kategori' }}</p>
                            </div>
                            <div class="flex-1 flex flex-col p-4 rounded-xl shadow-sm bg-gray-50 gap-1">
                                <h2 class="text-sm font-semibold text-gray-700">Total Student</h2>
                                <p class="text-gray-500 text-sm">0 Student</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 w-2/5 h-[360px]">
                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Course Benefits</h2>
                        <a href="{{ route('courses.benefits.create', $course->id) }}"
                            class="text-sm font-medium text-primary hover:opacity-80 transition">
                            Tambah
                        </a>
                    </div>

                    {{-- List --}}
                    @forelse ($course->benefits as $benefit)
                        <div
                            class="flex justify-between items-start bg-gray-50 rounded-lg p-3 mb-3 border border-gray-200 hover:shadow transition">
                            <p class="text-sm text-gray-700 leading-relaxed flex-1">
                                {{ $benefit->benefit }}
                            </p>
                            <div class="flex flex-col gap-1 ml-4 shrink-0">
                                <a href="{{ route('courses.benefits.edit', [$course->id, $benefit->id]) }}"
                                    class="text-xs text-blue-600 hover:underline hover:text-blue-800 transition">Edit</a>
                                <form action="{{ route('courses.benefits.destroy', [$course->id, $benefit->id]) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus benefit ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-xs text-red-600 hover:underline hover:text-red-800 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic">Belum ada benefit ditambahkan.</p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Course Content --}}
        @role('tutor')
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold">Course Content</h2>
                @if ($course->status == 'draft')
                    <a href="{{ route('courses.videos.create', $course->id) }}"
                        class="px-6 py-3 bg-primary text-white rounded-full hover:opacity-90 transition-colors">
                        <span class="font-medium">New Content</span>
                    </a>
                @endif
            </div>
        @endrole

        <div class="bg-white rounded-xl shadow-sm p-8 mt-4 w-2/3">
            @forelse($course->videos as $video)
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-md font-normal mb-4">{{ $video->title }}</h2>
                    <div class="mt-1">
                        @if ($course->status == 'draft' || $course->status == 'rejected')
                            <div class="flex items-center gap-2">
                                <a href="{{ route('courses.videos.edit', [$course->id, $video->id]) }}"
                                    class="px-6 py-3 rounded-full cursor-pointer hover:opacity-90 bg-primary text-white">Edit</a>
                                <form action="{{ route('courses.videos.destroy', [$course->id, $video->id]) }}"
                                    method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-6 py-3 rounded-full cursor-pointer hover:opacity-90 bg-red-500 text-white">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <li>Belum ada video.</li>
            @endforelse
        </div>
    </div>
@endsection
