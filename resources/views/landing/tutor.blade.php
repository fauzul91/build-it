@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="flex items-center justify-center px-4 h-[80vh]">
        <div class="container mx-auto flex items-center justify-center px-6 lg:px-12">
            <!-- Left Content -->
            <div class="flex flex-col items-center justify-center w-full space-y-6">
                <h1 class="text-4xl lg:text-6xl font-extrabold text-center leading-tight">
                    Jadikan ilmumu Bermakna, <br class="hidden md:block">
                    <span class="text-primary">                                 
                        Daftar Tutor Sekarang
                    </span>
                </h1>
                <p class="text-secondary text-xl opacity-80 text-center leading-relaxed">
                    Bagikan keahlianmu dan bantu lebih banyak orang belajar.<br>Yuk, mulai jadi tutor online sekarang!
                </p>
                <div class="pt-4">
                    <a href="{{ route('register.tutor') }}"
                        class="inline-flex items-center gap-3 rounded-full py-4 px-6 bg-primary text-white text-lg font-semibold hover:shadow-xl transition-all duration-300 ease-in-out">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
