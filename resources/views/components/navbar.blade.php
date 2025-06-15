<!-- Navbar -->
<nav id="nav-guest" class="sticky top-0 z-50 flex w-full bg-white shadow-md">
    <div class="flex w-[1280px] px-[65px] py-4 items-center justify-between mx-auto">
        <div class="flex items-center gap-[50px]">
            <a href="{{ route('landing.home') }}" class="flex shrink-0">
                <img src="{{ asset('assets/images/logos/build-it-logo.svg') }}" class="w-30" alt="logo">
            </a>
        </div>

        <div class="flex items-center gap-5 justify-end">
            @auth
                <ul class="flex items-center gap-10 mr-4">
                    @auth
                        @if (auth()->user()->hasRole('student'))
                            <a href="{{ route('landing.home') }}"
                                class="hover:font-semibold transition-all duration-300">Home</a>
                            <a href="{{ route('landing.course') }}"
                                class="hover:font-semibold transition-all duration-300">Kelas</a>
                            <a href="{{ route('landing.tutor') }}" class="hover:font-semibold transition-all duration-300">Jadi
                                Tutor</a>
                        @endif
                    @endauth
                </ul>
                <div class="flex items-center gap-3">
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('tutor'))
                        <a href="{{ route('dashboard') }}"
                            class="rounded-full py-3 px-5 bg-primary text-white font-semibold hover:drop-shadow-2xl transition-all duration-300">
                            Dashboard
                        </a>
                    @else
                        @php $namaDepan = explode(' ', auth()->user()->name)[0]; @endphp
                        <div x-data="{ open: false }" class="relative flex items-center gap-2">
                            @if (auth()->user()->photo)
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="avatar"
                                    class="w-10 h-10 rounded-full object-cover mr-2.5">
                            @else
                                <img src="{{ asset('assets\images\icons\profile-user.jpeg') }}" alt="avatar"
                                    class="w-10 h-10 rounded-full object-cover mr-2.5">
                            @endif
                            <span class="font-semibold text-[1rem] mr-2">Hello, {{ $namaDepan }}</span>

                            <button @click="open = !open" class="cursor-pointer">
                                <img src="{{ asset('assets/images/icons/arrow-circle-down.svg') }}" alt="dropdown icon"
                                    class="w-5 h-5">
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute top-full mt-2 right-0 bg-white shadow-md rounded-md w-[12.5rem] z-50">
                                <ul class="py-2">
                                    <li>
                                        <a href="{{ route('profile') }}"
                                            class="block px-4 py-4 hover:bg-gray-100">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile') }}"
                                            class="block px-4 py-4 hover:bg-gray-100">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="block px-4 py-4 hover:bg-gray-100"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            @endauth

            {{-- Guest User --}}
            @guest
                <div class="flex items-center gap-8 mr-4">
                    <a href="{{ route('landing.home') }}" class="hover:font-semibold transition-all duration-300">Home</a>
                    <a href="{{ route('landing.course') }}"
                        class="hover:font-semibold transition-all duration-300">Kelas</a>
                    <a href="{{ route('landing.tutor') }}" class="hover:font-semibold transition-all duration-300">Jadi
                        Tutor</a>
                    
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('register') }}"
                        class="rounded-full shadow-md py-3 px-5 bg-white text-black border border-transparent hover:border-primary transition-colors duration-300 ease-in-out">
                        <span class="font-semibold">Sign Up</span>
                    </a>
                    <a href="{{ route('login') }}"
                        class="rounded-full py-3 px-5 bg-primary hover:opacity-90 transition-all duration-300">
                        <span class="font-semibold text-white">Sign In</span>
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>

<script src="//unpkg.com/alpinejs" defer></script>
