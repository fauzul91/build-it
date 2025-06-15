@extends('layouts.dashboard')

@section('placeholder')
    Atur profil dan keamanan akun mu...
@endsection

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-1.5">Settings</h1>
        <p class="text-lg text-gray-500 mb-8">Atur profil dan keamanan akun mu</p>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 w-2/3 gap-8">
            <!-- Profile Section -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-semibold mb-4">My Profile</h2>
                <div class="flex items-center gap-6 mb-4">
                    <img id="photo-preview"
                        src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/icons/user.svg') }}"
                        class="w-24 h-24 rounded-full object-cover" alt="Profile">
                    <div>
                        <button type="button" onclick="document.getElementById('photo').click()"
                            class="px-4 py-2 bg-primary hover:opacity-90 cursor-pointer text-white rounded-full">
                            Upload Profile
                        </button>
                        <input type="file" id="photo" name="photo" class="hidden" form="profileForm">
                    </div>
                </div>

                <form id="profileForm" action="{{ route('settings.profile.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" disabled>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full">
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-primary text-white rounded-full mt-4 hover:bg-primary-dark transition-colors">
                        Save Profile
                    </button>
                </form>
            </div>

            <!-- Password Section -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-semibold mb-4">My Password</h2>
                <form action="{{ route('settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="current_password" class="block text-gray-700">Current Password</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="block text-gray-700">New Password</label>
                        <input type="password" id="new_password" name="new_password"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="block text-gray-700">Confirm Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" required>
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-primary text-white rounded-full mt-4 hover:bg-primary-dark transition-colors">
                        Change Password
                    </button>
                </form>
            </div>
        </div>

        <!-- WhatsApp Contact Section -->
        <div class="mt-8 p-8 bg-primary text-white rounded-xl shadow-sm w-2/3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10l4 4m0 0l4-4m-4 4V3" />
                    </svg>
                    <p class="text-xl">Mengalami Kendala?</p>
                </div>
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20mengalami%20kendala%20di%20akun%20saya"
                    target="_blank"
                    class="bg-white text-primary py-2 px-6 rounded-full hover:opacity-80 transition-opacity">
                    Hubungi Kami Via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection