@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="flex items-center justify-center px-4 py-12">
        <div class="container mx-auto w-full flex flex-col lg:flex-row items-start justify-between gap-10 px-6 lg:px-12">
            <div class="flex flex-col w-full lg:w-2/3">
                <img src="{{ asset('assets/images/photos/thumbnail-course-fullstack-mern.png') }}"
                    alt="Thumbnail Course Fullstack" class="w-full rounded-xl mb-8">
                <h1 class="text-2xl lg:text-3xl font-bold leading-tight mb-8">
                    Full-Stack JavaScript MERN 2025: Web Course LMS
                </h1>
                <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                <p class="text-secondary opacity-80 text-base leading-relaxed">
                    Selamat datang di Full-Stack JavaScript MERN 2025, kursus komprehensif yang dirancang untuk membekali
                    Anda dengan keterampilan membangun aplikasi web modern dari nol hingga siap produksi. Dalam kelas ini,
                    Anda akan mempelajari teknologi inti full-stack berbasis MERN (MongoDB, Express.js, React.js, dan
                    Node.js), serta praktik terbaik pengembangan web tahun 2025.
                    <br>
                    <br>
                    Kelas ini disajikan dalam format Web Course LMS (Learning Management System) interaktif, lengkap dengan
                    modul terstruktur, latihan praktis, dan proyek akhir yang akan menguji kemampuan Anda membangun aplikasi
                    web full-stack secara menyeluruh.
                    <br>
                    <br>
                    Yang akan Anda pelajari:
                    Dasar hingga lanjutan JavaScript modern (ES6+)
                    Pengelolaan backend dengan Node.js dan Express.js
                    Database NoSQL dengan MongoDB dan Mongoose
                    Pengembangan antarmuka interaktif dengan React.js
                    RESTful API & autentikasi menggunakan WT
                    Deployment aplikasi ke platform cloud (Vercel, Render, atau lainnya)
                    Integrasi Git & GitHub dalam workflow tim
                    <br>
                    <br>
                    Fitur Kelas:
                    LMS berbasis web dengan progress tracking
                    Video pembelajaran HD dan source code lengkap
                    Forum diskusi dan sesi mentoring mingguan
                    Sertifikat kelulusan
                    Akses selamanya ke materi
                    Cocok untuk: Pemula yang ingin menjadi Full-Stack Developer, mahasiswa TI, atau profesional yang ingin
                    meng-upgrade skill di bidang pengembangan web modern.
                </p>
            </div>

            <!-- Right Content -->
            <div class="flex flex-col w-full lg:w-1/3">
                <div class="flex flex-col gap-6 bg-white w-full rounded-2xl p-6 shadow mb-4">
                    <h3 class="font-semibold text-lg mb-2">10 Lessons</h3>
                    <div class="flex gap-4 px-6 py-3 bg-gray-100 rounded-3xl items-center cursor-pointer hover:drop-shadow-md">
                        <img src="{{ asset('assets/images/icons/video-play-icon.svg') }}" alt="Video Play Icon" class="w-7 h-7">
                        <h3 class="font-normal text-md">Course Trailer</h3>
                    </div>
                    <div class="flex gap-4 px-6 py-3 bg-gray-100 rounded-3xl items-center cursor-pointer hover:drop-shadow-md">
                        <img src="{{ asset('assets/images/icons/video-play-icon.svg') }}" alt="Video Play Icon" class="w-7 h-7">
                        <h3 class="font-normal text-md">Course Trailer</h3>
                    </div>  
                    <div class="flex gap-4 px-6 py-3 bg-gray-100 rounded-3xl items-center cursor-pointer hover:drop-shadow-md">
                        <img src="{{ asset('assets/images/icons/video-play-icon.svg') }}" alt="Video Play Icon" class="w-7 h-7">
                        <h3 class="font-normal text-md">Course Trailer</h3>
                    </div>
                    <div class="flex gap-4 px-6 py-3 bg-gray-100 rounded-3xl items-center cursor-pointer hover:drop-shadow-md">
                        <img src="{{ asset('assets/images/icons/video-play-icon.svg') }}" alt="Video Play Icon" class="w-7 h-7">
                        <h3 class="font-normal text-md">Course Trailer</h3>
                    </div>
                    <div class="flex gap-4 px-6 py-3 bg-gray-100 rounded-3xl items-center cursor-pointer hover:drop-shadow-md">
                        <img src="{{ asset('assets/images/icons/video-play-icon.svg') }}" alt="Video Play Icon" class="w-7 h-7">
                        <h3 class="font-normal text-md">Course Trailer</h3>
                    </div>
                </div>
                <div class="flex flex-col gap-3 bg-white w-full rounded-2xl p-6 shadow mb-4">
                    <h3 class="font-semibold text-lg mb-2">Tutor</h3>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/images/icons/profile-user.jpeg') }}" alt="Profile Tutor" class="w-12.5 h-12.5 rounded-full">
                        <div class="flex flex-col">
                            <h2 class="font-semibold text-lg">Udin Sedunia</h2>
                            <p class="text-[0.75rem] font-normal opacity-75">Mentor Full Stack Developer</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 bg-white w-full rounded-2xl p-6 shadow">
                    <h3 class="font-semibold text-lg mb-2">Benefits</h3>
                    <div class="flex items-center gap-4 mb-2">
                        <img src="{{ asset('assets/images/icons/benefit-icon.svg') }}" alt="Profile Tutor" class="w-12.5 h-12.5 rounded-full">
                        <h2 class="font-medium text-md mb-1">Skill Laravel Pasti Meningkat</h2>
                    </div>
                    <div class="flex items-center gap-4 mb-2">
                        <img src="{{ asset('assets/images/icons/benefit-icon.svg') }}" alt="Profile Tutor" class="w-12.5 h-12.5 rounded-full">
                        <h2 class="font-medium text-md mb-1">Pemahaman Web Stonks</h2>
                    </div>
                    <div class="flex items-center gap-4 mb-2">
                        <img src="{{ asset('assets/images/icons/benefit-icon.svg') }}" alt="Profile Tutor" class="w-12.5 h-12.5 rounded-full">
                        <h2 class="font-medium text-md mb-1">Auto Jago Dalam Semalam</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection