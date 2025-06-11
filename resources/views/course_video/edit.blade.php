@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-1.5">Edit Video "{{ $video->title }}" in "{{ $course->name }}"</h1>
        <p class="text-md text-gray-500 mb-8">Perbarui informasi konten video.</p>        

        <div class="grid grid-cols-1 w-2/3 gap-8">
            <div class="bg-white rounded-xl shadow-sm p-8">
                <form action="{{ route('courses.videos.update', [$course->id, $video->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Content Title</label>
                        <input type="text" id="title" name="title" class="w-full p-3 mt-2 border border-gray-300 rounded-full" required value="{{ old('title', $video->title) }}">
                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="youtube_id" class="block text-gray-700">YouTube Video ID</label>
                        <input type="text" id="youtube_id" name="youtube_id" class="w-full p-3 mt-2 border border-gray-300 rounded-full" required value="{{ old('youtube_id', $video->youtube_id) }}">
                        @error('youtube_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-1/3 py-3 bg-primary text-white rounded-full mt-4">Update Content</button>
                </form>
            </div>
        </div>
    </div>
@endsection 