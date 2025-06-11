@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-1.5">Add Course</h1>
        <p class="text-md text-gray-500 mb-8">Tambah course baru di platform.</p>

        <div class="grid grid-cols-1 w-2/3 gap-8">
            <div class="bg-white rounded-xl shadow-sm p-8">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Thumbnail input -->
                    <div class="flex items-center">
                        
                    </div>
                    <div class="mb-4">
                        <label for="thumbnail" class="block text-gray-700">Course Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" accept="image/*"
                            onchange="previewImage(event)">
                        @error('thumbnail')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thumbnail preview -->
                    <div class="flex items-center gap-6 mb-4">
                        <img id="previewIcon" src="{{ asset('storage/default-placeholder.png') }}" alt="Preview Thumbnail"
                            class="w-80 h-40 rounded-xl border border-gray-300" />
                    </div>

                    <!-- Title input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Course Title</label>
                        <input type="text" id="name" name="name"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" required
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category select -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700">Category</label>
                        <select id="category_id" name="category_id"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" required>
                            <option value="" disabled selected>Pilih category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700">Course Type</label>
                        <select id="type" name="type" class="w-full p-3 mt-2 border border-gray-300 rounded-full"
                            onchange="togglePriceInput()">
                            <option value="free" selected>Free</option>
                            <option value="paid">Paid</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 hidden" id="priceWrapper">
                        <label for="price" class="block text-gray-700">Course Price (Rp)</label>
                        <input type="number" id="price" name="price" min="0"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-full" placeholder="Masukkan harga course">
                        @error('price')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" rows="6"
                            class="w-full h-auto p-3 mt-2 border border-gray-300 rounded-lg">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-1/3 py-3 bg-primary hover:opacity-90 cursor-pointer text-white rounded-full mt-4">Create Course</button>
                    <a href="{{ route('courses.index') }}" class="ml-4 w-1/3 py-3 px-12 bg-white text-font shadow-md rounded-full mt-4 hover:bg-gray-50 cursor-pointer">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Image preview JS -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('previewIcon');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function togglePriceInput() {
            const type = document.getElementById('type').value;
            const priceWrapper = document.getElementById('priceWrapper');
            const priceInput = document.getElementById('price');

            if (type === 'paid') {
                priceWrapper.classList.remove('hidden');
                priceInput.setAttribute('required', 'required');
            } else {
                priceWrapper.classList.add('hidden');
                priceInput.removeAttribute('required');
                priceInput.value = '';
            }
        }

        // Panggil saat halaman dimuat, agar sesuai default (Free/Paid)
        document.addEventListener('DOMContentLoaded', togglePriceInput);
    </script>

    <!-- TinyMCE integration for rich editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
