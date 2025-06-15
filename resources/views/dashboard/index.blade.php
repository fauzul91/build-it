@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <h1></h1>
    <!-- Dashboard Cards -->
    <h1 class="text-2xl font-bold mb-1.5">Dashboard Overview</h1>
    <p class="opacity-70 mb-8">Ringkasan Statistik Aktivitas di BuildIt</p>
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-8">
            <h4 class="text-sm mb-2 text-font">Total Revenue</h4>
            <p class="text-3xl font-bold text-font">Rp1000K</p>
        </div>
        <div class="bg-white rounded-xl shadow p-8">
            <h4 class="text-sm mb-2 text-font">Total Course</h4>
            <p class="text-3xl font-bold text-font">20</p>
        </div>
        <div class="bg-white rounded-xl shadow p-8">
            <h4 class="text-sm mb-2 text-font">Total Customer</h4>
            <p class="text-3xl font-bold text-font">120</p>
        </div>
    </div>
@endsection