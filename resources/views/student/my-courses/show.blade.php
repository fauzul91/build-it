@extends('layouts.course-watch')

@section('course-video')
    <a href="{{ route('student.course') }}" class="text-font hover:shadow-sm text-md">Kembali</a>
    <div class="mt-4">
        <h2 class="text-md font-bold text-font mb-4">{{ $course->name }}</h2>
        <div class="mb-4">
            <div class="mb-2 text-sm font-medium text-font">
                Progress: {{ $completedCount }} dari {{ $totalVideos }} video ({{ $percentage }}%)
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-primary h-2 rounded-full" style="width: {{ $percentage }}%"></div>
            </div>
        </div>
        <ul id="video-list">
            @foreach ($course->videos as $video)
                @php
                    $isCompleted = $completedVideos->contains($video->id);
                @endphp
                <li>
                    <button type="button"
                        class="video-link block w-full text-left text-sm cursor-pointer px-6 py-3 mb-2 rounded-full transition
                    {{ $video->id == $currentVideo->id
                        ? 'bg-primary text-white font-bold'
                        : 'bg-light-grey text-font hover:bg-primary hover:text-white' }}"
                        data-id="{{ $video->id }}" data-title="{{ $video->title }}"
                        data-youtube-id="{{ $video->youtube_id }}" data-completed="{{ $isCompleted ? 'yes' : 'no' }}">
                        {{ $isCompleted ? '✔️' : '▶️' }} {{ $video->title }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('course-player')
    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">{{ $currentVideo->title }}</h2>

        <div class="w-full h-[70vh] rounded mb-6">
            <iframe class="w-full h-full rounded" src="https://www.youtube.com/embed/{{ $currentVideo->youtube_id }}"
                title="{{ $currentVideo->title }}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <div id="completion-status" class="text-right">
            @if (!$isCurrentVideoCompleted)
                <button id="mark-complete-button" data-id="{{ $currentVideo->id }}"
                    class="bg-primary hover:opacity-90 cursor-pointer text-white px-6 py-4 rounded-full font-semibold">
                    Tandai Selesai
                </button>
            @else
                <span
                    class="inline-block bg-black hover:bg-gray-600 cursor-pointer text-white px-6 py-4 rounded-full font-semibold">
                    Video ini telah ditandai selesai
                </span>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/video-progress-handler.js') }}"></script>
@endsection
