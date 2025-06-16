@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    @if (!$verif || $verif->status !== 'approved')
        <div class="bg-yellow-100 text-yellow-800 border border-yellow-300 px-4 py-3 rounded mb-6">
            @if (!$verif)
                Anda belum mengajukan verifikasi tutor.
                <a href="{{ route('tutor.verif.form') }}" class="text-blue-600 underline">Ajukan sekarang.</a>
            @elseif ($verif->status === 'pending')
                Pengajuan verifikasi Anda sedang diproses. Mohon tunggu persetujuan admin.
            @elseif ($verif->status === 'rejected')
                Pengajuan verifikasi ditolak: <strong>{{ $verif->rejection_reason }}</strong>.
                <a href="{{ route('tutor.verif.form') }}" class="text-blue-600 underline">Ajukan ulang.</a>
            @endif
        </div>
    @endif

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
