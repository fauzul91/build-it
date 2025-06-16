@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="flex items-center justify-center px-4 py-12">
        <div class="container mx-auto w-full flex flex-col lg:flex-row items-start justify-between gap-10 px-6 lg:px-12">
            <div class="flex flex-col w-full lg:w-2/3">
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                    class="w-full rounded-xl mb-8">
                <h1 class="text-2xl lg:text-3xl font-bold leading-tight mb-2">
                    {{ $course->name }}
                </h1>
                <p class="text-xl font-medium opacity-50 mb-8">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                <p class="text-secondary opacity-80 text-base leading-relaxed">
                    {{ $course->description }}
                </p>
            </div>

            <!-- Right Content -->
            <div class="flex flex-col w-full lg:w-1/3">
                <div class="flex flex-col gap-6 bg-white w-full rounded-2xl p-6 shadow mb-4">
                    <h3 class="font-semibold text-lg mb-2">10 Lessons</h3>
                    {{-- Tampilkan 4 video pertama --}}
                    @foreach ($course->videos->take(4) as $video)
                        <div
                            class="flex gap-4 px-6 py-3 bg-gray-100 rounded-3xl items-center cursor-pointer hover:drop-shadow-md">
                            <img src="{{ asset('assets/images/icons/video-play-icon.svg') }}" alt="Video Play Icon"
                                class="w-7 h-7">
                            <h3 class="font-normal text-md">{{ $video->title }}</h3>
                        </div>
                    @endforeach

                    @php
                        $totalVideos = $course->videos->count();
                        $remaining = $totalVideos - 4;
                    @endphp

                    @if ($remaining > 0)
                        <div
                            class="flex gap-4 px-6 py-3 bg-gray-100 rounded-3xl items-center cursor-pointer hover:drop-shadow-md">
                            <img src="{{ asset('assets/images/icons/video-play-icon.svg') }}" alt="Video Play Icon"
                                class="w-7 h-7">
                            <h3 class="font-normal text-md">+{{ $remaining }} video lainnya</h3>
                        </div>
                    @endif

                    <a href="{{ route('order.index', $course->slug) }}"
                        class="w-full bg-primary hover:opacity-90 text-center text-white font-semibold py-3 px-8 mb-4 rounded-xl transition duration-200 cursor-pointer">
                        Bergabung
                    </a>
                </div>
                <div class="flex flex-col gap-3 bg-white w-full rounded-2xl p-6 shadow mb-4">
                    <h3 class="font-semibold text-lg mb-2">Tutor</h3>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/images/icons/profile-user.jpeg') }}" alt="Profile Tutor"
                            class="w-12.5 h-12.5 rounded-full">
                        <div class="flex flex-col">
                            <h2 class="font-semibold text-lg">{{ $course->tutor->name }}</h2>
                            <p class="text-[0.75rem] font-normal opacity-75">Mentor Full Stack Developer</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 bg-white w-full rounded-2xl p-6 shadow">
                    <h3 class="font-semibold text-lg mb-2">Benefits</h3>
                    <div class="flex items-center gap-4 mb-2">
                        <img src="{{ asset('assets/images/icons/benefit-icon.svg') }}" alt="Profile Tutor"
                            class="w-12.5 h-12.5 rounded-full">
                        <h2 class="font-medium text-md mb-1">Skill Laravel Pasti Meningkat</h2>
                    </div>
                    <div class="flex items-center gap-4 mb-2">
                        <img src="{{ asset('assets/images/icons/benefit-icon.svg') }}" alt="Profile Tutor"
                            class="w-12.5 h-12.5 rounded-full">
                        <h2 class="font-medium text-md mb-1">Pemahaman Web Stonks</h2>
                    </div>
                    <div class="flex items-center gap-4 mb-2">
                        <img src="{{ asset('assets/images/icons/benefit-icon.svg') }}" alt="Profile Tutor"
                            class="w-12.5 h-12.5 rounded-full">
                        <h2 class="font-medium text-md mb-1">Auto Jago Dalam Semalam</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
