@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="flex items-center justify-center px-4 py-12">
        <div class="container flex items-center justify-between lg:px-12">
            <!-- Left Content -->
            <div class="w-full">
                <h1 class="text-3xl lg:text-4xl font-extrabold leading-tight mb-2">
                    Katalog Kelas
                </h1>
                <p class="text-secondary opacity-80 text-base leading-relaxed">
                    Mulai dari dasar sampai mahir, semua kelas IT di sini <br class="hidden sm:block">
                    siap bantu kamu belajar langkah demi langkah
                </p>
                <div class="
                grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 mt-12">
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
                                <a href="{{ route('course.detail', $course->slug) }}"
                                    class="rounded-full py-3 px-5 bg-primary hover:opacity-90 transition-all duration-300">
                                    <span class="font-semibold text-white">Selengkapnya</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-12">
                            <img src="{{ asset('assets/images/icons/crying-face.svg') }}" alt="Sorry Icon" class="w-15 h-auto mb-8">
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
            </div>
        </div>
    </section>
@endsection
