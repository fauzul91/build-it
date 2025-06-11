@extends('layouts.dashboard')

@section('placeholder')
    Cari transaksi terkini...
@endsection

@section('content')
    <h1></h1>
    <!-- Dashboard Cards -->
    <h1 class="text-2xl font-bold mb-1.5">Transactions</h1>
    <p class="opacity-70 mb-8">Pantau histori transaksi di platform.</p>
    <div class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm mt-8">
        <div class="flex items-center w-full justify-between p-8 gap-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('assets/images/photos/thumbnail-course-fullstack-mern.png') }}" alt="Thumbnail Course"
                    class="w-40 h-auto rounded-xl">
                <div class="flex flex-col w-full max-w-xs gap-2">
                    <h1 class="text-lg font-semibold break-words text-left">Full-Stack JavaScript MERN 2025: Web Course LMS</h1>
                    <div class="flex items-center gap-4">
                        <p class="text-font text-sm text-left opacity-70">Web Development</p>
                        <a href="#"
                            class="flex items-center px-3 py-1 text-[#00B058] bg-[#CEFFDD] rounded-full hover:opacity-90 transition-colors">
                            <span class="font-semibold text-[0.75rem]">SUCCESS</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="#"
                    class="flex items-center px-6 py-3 text-white bg-font rounded-full hover:opacity-90 transition-colors">
                    <span class="font-medium">Detail</span>
                </a>
            </div>
        </div>
        <div class="flex items-center w-full justify-between p-8 gap-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('assets/images/photos/thumbnail-course-fullstack-mern.png') }}" alt="Thumbnail Course"
                    class="w-40 h-auto rounded-xl">
                <div class="flex flex-col w-full max-w-xs gap-2">
                    <h1 class="text-lg font-semibold break-words text-left">Full-Stack JavaScript MERN 2025: Web Course LMS</h1>
                    <div class="flex items-center gap-4">
                        <p class="text-font text-sm text-left opacity-70">Web Development</p>
                        <a href="#"
                            class="flex items-center px-3 py-1 text-[#00B058] bg-[#CEFFDD] rounded-full hover:opacity-90 transition-colors">
                            <span class="font-semibold text-[0.75rem]">SUCCESS</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="#"
                    class="flex items-center px-6 py-3 text-white bg-font rounded-full hover:opacity-90 transition-colors">
                    <span class="font-medium">Detail</span>
                </a>
            </div>
        </div>
        <div class="flex items-center w-full justify-between p-8 gap-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('assets/images/photos/thumbnail-course-fullstack-mern.png') }}" alt="Thumbnail Course"
                    class="w-40 h-auto rounded-xl">
                <div class="flex flex-col w-full max-w-xs gap-2">
                    <h1 class="text-lg font-semibold break-words text-left">Full-Stack JavaScript MERN 2025: Web Course LMS</h1>
                    <div class="flex items-center gap-4">
                        <p class="text-font text-sm text-left opacity-70">Web Development</p>
                        <a href="#"
                            class="flex items-center px-3 py-1 text-[#00B058] bg-[#CEFFDD] rounded-full hover:opacity-90 transition-colors">
                            <span class="font-semibold text-[0.75rem]">SUCCESS</span>
                        </a>
                    </div>
                </div>
            </div>                          
            <div class="flex items-center gap-4">
                <a href="#"
                    class="flex items-center px-6 py-3 text-white bg-font rounded-full hover:opacity-90 transition-colors">
                    <span class="font-medium">Detail</span>
                </a>
            </div>
        </div>
    </div>
@endsection
