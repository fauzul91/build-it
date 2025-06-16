@extends('layouts.course-watch')

@section('course-video')
    <div class="mt-8">
        <h2 class="text-md font-bold text-font mb-4">{{ $course->name }}</h2>
        <ul id="video-list">
            @foreach ($course->videos as $video)
                @php
                    $isCompleted = $completedVideos->contains($video->id);
                @endphp
                <li>
                    <a href="{{ route('student.course.show', $course->slug) }}?v={{ $video->id }}"
                        class="block w-full text-left text-sm cursor-pointer px-6 py-3 mb-2 rounded-full transition
                            {{ $video->id == $currentVideo->id 
                                ? 'bg-primary text-white font-bold' 
                                : 'bg-light-grey text-font hover:bg-primary hover:text-white' }}">
                        {{ $isCompleted ? '✔️' : '▶️' }} {{ $video->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('course-player')
    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">{{ $currentVideo->title }}</h2>

        <div class="w-full h-[75vh] rounded mb-6">
            <iframe class="w-full h-full rounded"
                src="https://www.youtube.com/embed/{{ $currentVideo->youtube_id }}"
                title="{{ $currentVideo->title }}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        @if (!$isCurrentVideoCompleted)
            <form action="{{ route('student.course.progress', $currentVideo->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg font-semibold">
                    Tandai Selesai ✅
                </button>
            </form>
        @else
            <span class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded">
                Video ini telah ditandai selesai ✔️
            </span>
        @endif
    </div>
@endsection