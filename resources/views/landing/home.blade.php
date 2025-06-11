@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="flex items-center justify-center px-4 py-12">
        <div class="container mx-auto flex items-center justify-between px-6 lg:px-12">
            <!-- Content -->
            <div class="w-full lg:w-3/5 space-y-6">
                <p class="inline-flex items-center gap-2 rounded-full py-2 px-4 bg-light-blue">
                    <span class="font-bold text-sm">MULAI BELAJAR IT DARI TEMPAT YANG TEPAT</span>
                </p>
                <h1 class="text-4xl lg:text-[3.5rem] font-bold leading-tight">
                    Dari Nol Jadi Pro, <br class="hidden md:block">Belajar IT Tanpa Batas
                </h1>
                <p class="text-secondary opacity-80 text-base leading-relaxed">
                    Mulai perjalananmu di dunia IT dengan platform ramah pemula,<br class="hidden sm:block">
                    materi praktis, mentor ahli, dan akses belajar fleksibel.
                </p>
                <div class="pt-4">
                    <a href="{{ route('landing.course') }}"
                        class="inline-flex items-center gap-3 rounded-full py-4 px-6 bg-primary text-white text-lg font-semibold hover:shadow-xl transition-all duration-300 ease-in-out">
                        Jelajahi Kelas
                    </a>
                </div>
            </div>

            <!-- Aside Image -->
            <aside class="hidden lg:block w-2/5">
                <img src="{{ asset('assets/images/photos/aside-build-it.png') }}" alt="Course" class="w-full h-auto" />
            </aside>
        </div>
    </section>
@endsection
