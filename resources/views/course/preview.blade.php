@extends('layouts.course-preview')

@section('placeholder')
    Cari course terkini...
@endsection

@section('course-video')
    <div class="mt-8">
        @if ($course && $course->videos && $course->videos->count() > 0)
            <h2 class="text-md font-bold text-font mb-4">{{ $course->name }}</h2>
            <ul id="video-list">
                @foreach ($course->videos as $index => $video)
                    <li>
                        <button type="button"
                            class="video-link w-full text-left text-sm cursor-pointer px-6 py-3 mb-2 rounded-full
                                transition bg-light-grey text-font hover:bg-primary hover:text-white
                                @if ($index === 0) font-bold text-white bg-primary hover:opacity-90 hover:text-white @endif"
                            data-title="{{ $video->title }}" data-youtube-id="{{ $video->youtube_id }}">
                            &gt; {{ $video->title }}
                        </button>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Belum ada video untuk course ini.</p>
        @endif
    </div>
@endsection

@section('content')
    @php
        $firstVideo = $course && $course->videos && $course->videos->count() > 0 ? $course->videos->first() : null;
    @endphp

    <div class="p-6 bg-white rounded shadow">
        @if ($firstVideo)
            <h2 id="video-title" class="text-xl font-bold mb-4">{{ $firstVideo->title }}</h2>

            <div class="w-full h-[75vh] rounded">
                <iframe id="video-iframe" class="w-full h-full rounded"
                    src="https://www.youtube.com/embed/{{ $firstVideo->youtube_id }}" title="{{ $firstVideo->title }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        @else
            <h2 class="text-xl font-bold mb-4 text-gray-500">Tidak ada video untuk ditampilkan.</h2>
        @endif
    </div>

    @if ($course && $course->videos && $course->videos->count() > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const videoLinks = document.querySelectorAll('.video-link');
                const videoTitle = document.getElementById('video-title');
                const videoIframe = document.getElementById('video-iframe');

                videoLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        const title = this.getAttribute('data-title');
                        const youtubeId = this.getAttribute('data-youtube-id');

                        videoTitle.textContent = title;
                        videoIframe.src = `https://www.youtube.com/embed/${youtubeId}`;
                        videoIframe.title = title;

                        videoLinks.forEach(l => {
                            l.classList.remove('bg-primary', 'text-white', 'font-bold',
                                'active');
                            l.classList.add('bg-light-grey', 'text-font');
                        });

                        this.classList.add('bg-primary', 'text-white', 'font-bold', 'active');
                        this.classList.remove('bg-light-grey', 'text-font');
                    });
                });
            });
        </script>
    @endif
@endsection