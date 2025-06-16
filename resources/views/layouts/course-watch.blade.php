@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <aside class="w-64 bg-white shadow-md px-6 py-8 overflow-y-auto sticky top-0 h-screen">
        <nav class="space-y-4">
            @yield('course-video') 
        </nav>
    </aside>

    <main class="flex-1 bg-gray-50 overflow-y-auto">
        <div class="px-8 py-6">
            @yield('course-player')
        </div>
    </main>
</div>
@endsection