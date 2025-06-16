@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-1.5">Add Course Benefit to "{{ $course->name }}"</h1>
        <p class="text-md text-gray-500 mb-8">Tambah benefit untuk kursus.</p>        

        <div class="grid grid-cols-1 w-2/3 gap-8">
            <div class="bg-white rounded-xl shadow-sm p-8">
                <form action="{{ route('courses.benefits.store', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="benefit" class="block text-gray-700">Content Benefit</label>
                        <input type="text" id="benefit" name="benefit" class="w-full p-3 mt-2 border border-gray-300 rounded-full" required value="{{ old('benefit') }}">
                        @error('benefit')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-1/3 py-3 bg-primary text-white rounded-full mt-4">Create Benefit</button>
                </form>
            </div>
        </div>
    </div>
@endsection