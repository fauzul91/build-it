<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
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
            <div class="flex items-center justify-center mb-10">
                <img src="{{ asset('assets/images/logos/build-it-logo.svg') }}" alt="BuildIT Logo" class="h-10">
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col">
                <div class="mb-6">
                    <h3 class="text-xs font-semibold text-font uppercase tracking-wider mb-4 px-3">Main Menu</h3>
                    <ul class="flex flex-col gap-6">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                <i class="fas fa-home w-5 text-center text-font"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>
                        @role('tutor')
                            <li>
                                <a href="{{ route('courses.index') }}"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                    <i class="fas fa-chalkboard-teacher w-5 text-center text-font"></i>
                                    <span class="font-medium">Courses</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('course.tutor.status') }}"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                    <i class="fas fa-chalkboard-teacher w-5 text-center text-font"></i>
                                    <span class="font-medium">Status Course</span>
                                </a>
                            </li>
                        @endrole
                        @role('admin')
                            <li>
                                <a href="{{ route('categories.index') }}"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                    <i class="fas fa-layer-group w-5 text-center text-font"></i>
                                    <span class="font-medium">Categories</span>
                                </a>
                            </li>
                            <!-- Dropdown untuk Course -->
                            <li x-data="{ open: true }" class="relative">
                                <button @click="open = !open"
                                    class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-font hover:text-primary transition-colors cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-book-open w-5 text-center text-font"></i>
                                        <span class="font-medium">Courses</span>
                                    </div>
                                    <i class="fas fa-chevron-down" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                <ul x-show="open" x-transition class="mt-2 pl-8 flex flex-col gap-3 text-sm text-gray-700">
                                    <li class="px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                        <a href="{{ route('course.verification.index') }}" class="font-medium">Verifikasi
                                            Course</a>
                                    </li>
                                    <li class="px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                        <a href="{{ route('course.active.index') }}" class="font-medium">Course
                                            Aktif</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Dropdown untuk Tutor -->
                            <li x-data="{ open: true }" class="relative">
                                <button @click="open = !open"
                                    class="w-full flex items-center cursor-pointer justify-between px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-chalkboard-teacher w-5 text-center text-font"></i>
                                        <span class="font-medium">Tutors</span>
                                    </div>
                                    <i class="fas fa-chevron-down" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                <ul x-show="open" x-transition class="mt-2 pl-8 flex flex-col gap-3 text-sm text-gray-700">
                                    <li class="px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                        <a href="{{ route('tutor.pending') }}" class="font-medium">Verifikasi
                                            Tutor</a>
                                    </li>
                                    <li class="px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                        <a href="{{ route('tutor.active') }}" class="font-medium">Tutor Aktif</a>
                                    </li>
                                </ul>
                            </li>
                        @endrole
                        <li>
                            <a href="{{ route('transaction.index') }}"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                <i class="fas fa-receipt w-5 text-center text-font"></i>
                                <span class="font-medium">Transactions</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Settings Section -->
                <div class="mt-2">
                    <h3 class="text-xs font-semibold text-font uppercase tracking-wider mb-4 px-3">Account Settings
                    </h3>
                    <ul class="flex flex-col gap-6">
                        <li>
                            <a href="{{ route('settings') }}"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-font hover:text-primary transition-colors">
                                <i class="fas fa-cog w-5 text-center text-font"></i>
                                <span class="font-medium">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-light-blue">
            <!-- Top Bar -->
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
                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="avatar"
                                class="w-10 h-10 rounded-full object-cover mr-2.5">
                        @else
                            <img src="{{ asset('assets\images\icons\profile-user.jpeg') }}" alt="avatar"
                                class="w-10 h-10 rounded-full object-cover mr-2.5">
                        @endif
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
