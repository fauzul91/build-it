@extends('layouts.dashboard')

@section('placeholder')
    Cari kategori terkini...
@endsection

@section('content')
    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h1 class="text-2xl font-bold mb-1.5">Manage Categories</h1>
            <p class="opacity-70">Atur seluruh category aktif di platform.</p>
        </div>
        <a href="{{ route('categories.create') }}"
            class="flex items-center px-6 py-3 text-white bg-primary rounded-full hover:opacity-90 transition-colors">
            <span class="font-medium">New Category</span>
        </a>
    </div>

    @if (session('success'))
        @foreach ((array) session('success') as $message)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-6 mb-2">
                {{ $message }}
            </div>
        @endforeach
    @endif

    <div class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm mt-8">
        @foreach ($categories as $category)
            <div class="flex items-center w-full justify-between p-8 gap-4">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/photos/category-course.png') }}" alt="Thumbnail Course"
                        class="w-16 h-auto rounded-full">
                    <div class="flex flex-col w-full max-w-xs">
                        <h1 class="text-xl font-semibold break-words text-left">{{ $category->name }}</h1>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('categories.edit', $category) }}"
                        class="flex items-center px-6 py-3 text-white bg-primary rounded-full hover:opacity-90 transition-colors">
                        <span class="font-medium">Edit</span>
                    </a>
                    <a href="#"
                        class="flex items-center px-6 py-3 text-white bg-[#FF0000] rounded-full hover:opacity-90 transition-colors">
                        <span class="font-medium">Delete</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
