@extends('layouts.dashboard')

@php
    use Illuminate\Support\Carbon;

    $invoiceId = 'INV-' . $tutorTrx->created_at->format('Ymd') . '-' . str_pad($tutorTrx->id, 4, '0', STR_PAD_LEFT);
    $formattedDate = Carbon::parse($tutorTrx->created_at)->format('d M Y, H:i');
@endphp

@section('content')
    <a href="{{ route('tutor.transaction') }}" class="inline-flex items-center text-font hover:text-primary mb-4">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali
    </a>

    <h1 class="text-3xl font-bold mb-2 text-gray-800">Detail Transaksi</h1>
    <p class="text-gray-500 mb-8">Pantau transaksimu di platform</p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 bg-white rounded-lg p-6 shadow-md">
        <div class="flex flex-col">
            <img src="{{ asset('storage/' . $tutorTrx->course->thumbnail) }}" class="w-80 h-auto rounded-md mb-4"
                alt="{{ $tutorTrx->course->name }}">

            <h2 class="font-semibold text-xl mb-2">{{ $tutorTrx->course->name }}</h2>
            <p class="text-gray-600 text-lg mb-4">Rp {{ number_format($tutorTrx->amount) }}</p>

            <span
                class="text-sm px-4 py-1 rounded-full w-max
    {{ $tutorTrx->status === 'completed'
        ? 'bg-green-100 text-green-700'
        : ($tutorTrx->status === 'pending'
            ? 'bg-yellow-100 text-yellow-700'
            : 'bg-red-100 text-red-700') }}">
                {{ strtoupper($tutorTrx->status) }}
            </span>
        </div>

        <div class="flex flex-col space-y-6">
            <div>
                <h2 class="text-sm text-gray-500">Nomor Transaksi</h2>
                <p class="text-lg font-semibold">{{ $invoiceId }}</p>
            </div>
            <div>
                <h2 class="text-sm text-gray-500">Tanggal & Waktu Transaksi</h2>
                <p class="text-lg font-semibold">{{ $formattedDate }}</p>
            </div>
            <div>
                <h2 class="text-sm text-gray-500 mb-1">Metode Pembayaran</h2>
                <span class="inline-block bg-black text-white px-4 py-2 rounded-full text-sm font-semibold">Midtrans</span>
            </div>
            <div class="border-t pt-4">
                <h2 class="text-sm text-gray-500 mb-3">Rincian Pembayaran</h2>
                <div class="flex justify-between text-sm mb-2">
                    <span>Harga Kelas</span>
                    <span>Rp {{ number_format($tutorTrx->course_price) }}</span>
                </div>
                <div class="flex justify-between font-bold text-base">
                    <span>Total Transfer</span>
                    <span>Rp {{ number_format($tutorTrx->amount) }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
