@extends('layouts.student')

@section('student-content')
    <div class="container">
        <h1 class="text-3xl font-bold mb-1.5">Kelas Saya</h1>
        <p class="text-lg text-gray-500 mb-8">Lihat semua kelas yang anda ikuti.</p>

        @if ($courses->count())
            <div class="
                grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">
                @forelse ($courses as $course)
                    <div
                        class="flex flex-col rounded-xl bg-white shadow-md hover:shadow-lg transition-shadow duration-300 cursor-pointer">
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                            class="rounded-t-xl h-40 object-cover w-full" />
                        <div class="p-4 space-y-2">
                            <h3 class="text-lgw font-semibold text-gray-800">{{ $course->name }}</h3>
                            <p class="text-sm text-gray-600">Rp{{ number_format($course->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="px-4 py-4 mb-4 space-y-2">
                            <a href="{{ route('student.course.show', $course->slug) }}"
                                class="rounded-full py-3 px-5 bg-primary hover:opacity-90 transition-all duration-300">
                                <span class="text-md font-semibold text-white">Mulai Belajar</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12">
                        <img src="{{ asset('assets/images/icons/crying-face.svg') }}" alt="Sorry Icon"
                            class="w-15 h-auto mb-8">
                        <h3 class="text-xl font-semibold text-gray-600 mb-1">Belum ada kelas tersedia</h3>
                        <p class="text-gray-500 text-center max-w-md mb-4">Kami sedang mempersiapkan kelas terbaik untuk
                            Anda.<br>Silakan cek kembali nanti.</p>
                        <a href="{{ route('landing.home') }}"
                            class="mt-4 px-6 py-3 font-semibold bg-primary text-white rounded-full hover:bg-primary-dark transition-colors">
                            Kembali ke Beranda
                        </a>
                    </div>
                @endforelse
            </div>
        @else
            <p class="text-gray-500">Kamu belum membeli kursus apa pun.</p>
        @endif
    </div>
@endsection
