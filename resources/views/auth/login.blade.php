@extends('layouts.auth')

@section('content')
    <div class="w-full max-w-md rounded-2xl shadow-md px-12 py-15 bg-white">
        <h1 class="text-[1.75rem] font-extrabold text-center text-gray-700 mb-2">Halo, Selamat Datang</h1>
        <h3 class="text-center font-medium text-gray-700 mb-12">Silakan masuk untuk melanjutkan</h3>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-8">
                <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border bg-white border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary"
                    value="{{ old('email') }}" required>
            </div>

            <div class="mb-12">
                <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border bg-white border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-primary hover:opacity-90 text-white font-semibold py-3 px-8 mb-4 rounded-xl transition duration-200 cursor-pointer">
                Login
            </button>

            {{-- <h3 class="text-center font-light text-[0.75rem] mb-4 text-gray-700">- atau masuk menggunakan -</h3>

            <a href="{{ route('google-redirect', ['role' => 'student']) }}"
                class="w-full flex items-center mb-4 justify-center gap-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-semibold py-3 px-6 rounded-xl transition duration-200 shadow-md">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                <span>Login dengan Google</span>
            </a> --}}

            <a href="{{ route('register') }}" class="block text-center text-sm">Belum punya akun? <span
                    class="font-semibold cursor-pointer text-primary">Daftar Sekarang!</span></a>
        </form>
    </div>
@endsection
