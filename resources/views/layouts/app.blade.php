<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <title>BuildIT - Course IT Handal dan Terpercaya</title>
    <meta name="description"
        content="BuildIT - Course IT Handal dan Terpercaya" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets\images\icons\icon-build-it.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets\images\icons\icon-build-it.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="BuildIT - Course IT Handal dan Terpercaya" />
    <meta name="og:description" content="BuildIT adalah platform pembelajaran online terpercaya yang menyediakan kursus IT berkualitas untuk membangun karier digital Anda. Mulai dari pemrograman hingga desain, semua tersedia untuk membantu Anda menjadi profesional handal di dunia teknologi." />
    <meta property="og:image" content="{{ asset('assets\images\icons\icon-build-it.png') }}">
    <meta property="og:type" content="website">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class= "font-family-sans flex flex-col">
    <x-navbar/>
    @yield('content')
    {{-- <x-footer/> --}}
</body>
@stack('scripts')