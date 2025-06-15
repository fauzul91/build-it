@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-1.5">Edit Category</h1>
        <p class="text-lg text-gray-500 mb-8">Atur seluruh kategori kelas di platform.</p>

        <div class="grid grid-cols-1 w-2/3 gap-8">
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-semibold mb-4">Category Icon</h2>

                <div class="flex items-center gap-6 mb-4">
                    @if($category->icon)
                        <img id="previewIcon" src="{{ asset('storage/' . $category->icon) }}" alt="Preview Icon"
                             class="w-24 h-24 rounded-full border-2 border-gray-300" />
                    @else
                        <img id="previewIcon" src="{{ asset('storage/default-placeholder.png') }}" alt="Preview Icon"
                             class="w-24 h-24 rounded-full border-2 border-gray-300" />
                    @endif
                </div>
                
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="icon" class="block text-gray-700">Category Icon</label>
                        <input type="file" id="icon" name="icon" class="w-full p-3 mt-2 border border-gray-300 rounded-full" accept="image/*" onchange="previewImage(event)">
                        @error('icon')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Category Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="w-full p-3 mt-2 border border-gray-300 rounded-full" required>
                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-1/3 py-3 bg-primary hover:opacity-90 cursor-pointer text-white rounded-full mt-4">Update Category</button>
                    <a href="{{ route('categories.index') }}" class="ml-4 w-1/3 py-3 bg-white text-font hover:shadow-md rounded-full mt-4 text-center inline-block">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('previewIcon');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection