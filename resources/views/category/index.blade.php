@extends('layouts.dashboard')

@section('head-content')
    <div class="relative mb-6">
        <input type="text" id="search-category" placeholder="Cari nama kategori..."
            class="w-full pl-10 pr-4 py-2 rounded-full bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary transition" />
        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
    </div>
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

    @if (session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mt-6 mb-2">
            {{ session('error') }}
        </div>
    @endif

    {{-- Daftar kategori --}}
    <div id="category-list" class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm mt-8">
        @foreach ($categories as $category)
            <div class="flex items-center w-full justify-between p-8 gap-4">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/photos/category-course.png') }}" alt="Thumbnail"
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
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        class="delete-category-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center px-6 py-3 text-white bg-[#FF0000] rounded-full hover:opacity-90 transition-colors">
                            <span class="font-medium">Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function attachDeleteSwal() {
            document.querySelectorAll('.delete-category-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Category will be deleted permanently!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        }
        attachDeleteSwal();        
    </script>
    <script src="{{ asset('js/admin-category-search.js') }}"></script>
@endsection