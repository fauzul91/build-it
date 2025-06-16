<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <title>BuildIT - Course IT Handal dan Terpercaya</title>
    <meta name="description" content="BuildIT - Course IT Handal dan Terpercaya" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icons/icon-build-it.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/icons/icon-build-it.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="BuildIT - Course IT Handal dan Terpercaya" />
    <meta name="og:description"
        content="BuildIT adalah platform pembelajaran online terpercaya yang menyediakan kursus IT berkualitas untuk membangun karier digital Anda. Mulai dari pemrograman hingga desain, semua tersedia untuk membantu Anda menjadi profesional handal di dunia teknologi." />
    <meta property="og:image" content="{{ asset('assets/images/icons/icon-build-it.png') }}">
    <meta property="og:type" content="website">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-family-sans flex flex-col bg-gray-50">
    <div class="flex h-screen">
        <aside class="w-64 bg-white shadow-md px-6 py-8 flex flex-col">
            <nav class="flex flex-col">
                <a href="{{  url()->previous() }}" class="text-font hover:shadow-sm text-md">Kembali</a>
                @yield('course-video')
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto bg-light-blue">
            <div class="px-8 py-6 flex justify-between items-center sticky top-0 z-10 bg-white">
                <div class="w-1/2">
                    <div class="relative">
                        <input type="text" placeholder="@yield('placeholder')"
                            class="w-full pl-10 pr-4 py-2 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary transition" />
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center space-x-2">
                        <img src="https://i.pravatar.cc/32" class="w-10 h-10 rounded-full" />
                    </div>
                    <div class="flex flex-col">
                        <span class="text-font font-semibold">Hello, {{ auth()->user()->name }}</span>
                        <p class="text-sm opacity-70">
                            {{ ucfirst(auth()->user()->getRoleNames()->first()) }}
                        </p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-font transition-colors cursor-pointer">
                            <i class="fas fa-sign-out-alt text-font hover:text-red-500"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="px-8 py-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>
@stack('scripts')
