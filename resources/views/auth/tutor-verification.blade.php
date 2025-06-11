@extends('layouts.auth')

@section('content')
    <div class="w-full max-w-md rounded-2xl shadow-md px-12 py-12 bg-white">
        <h1 class="text-[1.75rem] font-extrabold text-center text-gray-700 mb-2">Verifikasi Tutor</h1>
        <h3 class="text-center font-medium text-gray-700 mb-8">Lengkapi data berikut untuk verifikasi akun tutor Anda</h3>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tutor.verif.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="portofolio" class="block text-gray-600 text-sm font-medium mb-2">Upload Portofolio (CV atau Dokumen Pendukung)</label>
                <input type="file" name="portofolio" id="portofolio"
                    class="w-full text-gray-600 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary"
                    accept=".pdf,.doc,.docx" required>
            </div>
            
            <div class="mb-4">
                <label for="linkedin_url" class="block text-gray-600 text-sm font-medium mb-2">Link LinkedIn</label>
                <input type="url" name="linkedin_url" id="linkedin_url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary"
                    placeholder="https://linkedin.com/in/username" value="{{ old('linkedin_url') }}" required>
            </div>
            
            <div class="mb-4">
                <label for="github_url" class="block text-gray-600 text-sm font-medium mb-2">Link GitHub</label>
                <input type="url" name="github_url" id="github_url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-primary"
                    placeholder="https://github.com/username" value="{{ old('github_url') }}">
            </div>

            <button type="submit"
                class="w-full bg-primary hover:opacity-90 text-white font-semibold py-3 px-8 mb-4 rounded-xl transition duration-200 cursor-pointer">
                Kirim Verifikasi
            </button>
        </form>
    </div>
@endsection