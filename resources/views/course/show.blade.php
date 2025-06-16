@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <div class="container mx-auto">
        {{-- Header & Preview Button --}}
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-3xl font-bold mb-4">{{ $course->name }}</h1>
            <a href="{{ auth()->user()->hasRole('admin') 
                        ? route('admin.course.preview', ['course' => $course->id])
                        : route('tutor.course.preview', ['course' => $course->id]) }}"
                class="px-6 py-3 bg-white text-font rounded-full hover:shadow-md transition">
                <span class="font-medium">Preview</span>
            </a>
        </div>

        @role('tutor')
            @if ($course->status === 'rejected' && $course->rejection_reason)
                <div class="my-6 bg-red-100 text-red-800 p-4 rounded-lg border border-red-300 w-2/3">
                    <h2 class="font-semibold text-lg mb-1">Alasan Penolakan</h2>
                    <p>{{ $course->rejection_reason }}</p>
                </div>
            @endif
        @endrole

        <div class="flex gap-8 mb-4">
            <div class="bg-white rounded-xl shadow-sm p-6 w-3/5 h-[360px] flex flex-col justify-center gap-5">
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                    class="w-full h-40 rounded-xl border object-cover mb-4">
                <div class="flex gap-4">
                    <div class="flex-1 p-4 rounded-xl shadow-sm bg-gray-50">
                        <h2 class="text-sm font-semibold text-gray-700">Course Category</h2>
                        <p class="text-gray-500 text-sm">{{ $course->category->name ?? 'Kategori' }}</p>
                    </div>
                    <div class="flex-1 p-4 rounded-xl shadow-sm bg-gray-50">
                        <h2 class="text-sm font-semibold text-gray-700">Total Student</h2>
                        <p class="text-gray-500 text-sm">0 Student</p>
                    </div>
                </div>
            </div>

            {{-- Right: Benefits --}}
            <div class="bg-white rounded-2xl shadow-md p-6 w-2/5 h-[360px]">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Course Benefits</h2>
                    @role('tutor')
                        @if ($course->status === 'draft')
                            <a href="{{ route('courses.benefits.create', $course->id) }}"
                                class="text-sm font-medium text-primary hover:opacity-80 transition">
                                Tambah
                            </a>
                        @endif
                    @endrole
                </div>

                @forelse ($course->benefits as $benefit)
                    <div class="flex justify-between items-start bg-gray-50 rounded-lg p-3 mb-3 hover:shadow transition">
                        <p class="text-sm text-gray-700 flex-1">{{ $benefit->benefit }}</p>
                        @role('tutor')
                            @if ($course->status === 'draft')
                                <div class="flex flex-col gap-1 ml-4 shrink-0">
                                    <a href="{{ route('courses.benefits.edit', [$course->id, $benefit->id]) }}"
                                        class="text-xs text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('courses.benefits.destroy', [$course->id, $benefit->id]) }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus benefit ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        @endrole
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic">Belum ada benefit ditambahkan.</p>
                @endforelse
            </div>
        </div>

        {{-- Course Content --}}
        <div class="flex items-center justify-between mt-10 mb-2">
            <h2 class="text-xl font-semibold">Course Content</h2>
            @role('tutor')
                @if ($course->status === 'draft')
                    <a href="{{ route('courses.videos.create', $course->id) }}"
                        class="px-6 py-3 bg-primary text-white rounded-full hover:opacity-90 transition">
                        New Content
                    </a>
                @endif
            @endrole
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 mt-4 w-2/3">
            @forelse ($course->videos as $video)
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-md font-normal">{{ $video->title }}</h2>
                    @if (in_array($course->status, ['draft', 'rejected']))
                        <div class="flex items-center gap-2">
                            <a href="{{ route('courses.videos.edit', [$course->id, $video->id]) }}"
                                class="px-6 py-3 rounded-full bg-primary text-white hover:opacity-90">Edit</a>
                            <form action="{{ route('courses.videos.destroy', [$course->id, $video->id]) }}"
                                method="POST" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-6 py-3 rounded-full bg-red-500 text-white hover:opacity-90">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-sm text-gray-500 italic">Belum ada video.</p>
            @endforelse
        </div>
    </div>
@endsection
