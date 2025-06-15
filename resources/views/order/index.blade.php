@extends('layouts.app')

@section('content')
    <div class="p-8 mt-10 flex flex-col items-center justify-center">
        <h1 class="text-center text-[2.5rem] font-bold">Checkout Course</h1>
        <p class="text-center opacity-80">Mulai langkahmu menuju skill impian. Satu klik, <br>ubah perjalananmu!</p>
    </div>
    <div class="flex items-stretch justify-center p-8 gap-6">
        {{-- Left Section --}}
        <div class="w-1/2 p-5 h-full">
            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}" class="w-full rounded-xl mb-8">
            <h1 class="text-2xl lg:text-3xl font-bold leading-tight mb-8">
                {{ $course->name }}
            </h1>
        </div>

        {{-- Right Section --}}
        <div class="flex flex-col w-1/2 shadow-md rounded-xl bg-white p-5 h-full">
            {{-- Metode Pembayaran --}}
            <h2 class="font-semibold mb-2">Metode Pembayaran</h2>
            <div class="w-1/5 flex bg-font px-3 py-3 rounded-full text-white mb-8">
                <span class="mx-auto">Midtrans</span>
            </div>

            {{-- Detail Pembayaran --}}
            <h2 class="font-semibold mb-4">Payment Detail</h2>
            <div class="flex flex-col gap-4">
                <div class="flex justify-between">
                    <h2>Harga Kelas</h2>
                    <h2>Rp{{ number_format($course->price, 0, ',', '.') }}</h2>
                </div>
                <div class="flex justify-between">
                    <h2>Total Transfer</h2>
                    <h2>Rp{{ number_format($course->price, 0, ',', '.') }}</h2>
                </div>
            </div>

            <form action="{{ route('order.checkout', $course->slug) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full mt-8 bg-primary hover:opacity-90 text-center text-white font-semibold py-3 px-8 mb-4 rounded-full transition duration-200 cursor-pointer">
                    Bayar & Gabung Kelas
                </button>
            </form>
        </div>
    </div>
@endsection