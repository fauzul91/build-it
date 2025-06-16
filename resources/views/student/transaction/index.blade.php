@extends('layouts.student')

@section('student-content')
    <h1 class="text-3xl font-bold mb-2 text-gray-800">Transactions</h1>
    <p class="text-gray-500 mb-8">Pantau transaksimu di platform</p>

    <div class="bg-white rounded-lg p-6 shadow-md space-y-6">
        @foreach ($studentTrx as $trx)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $trx->course->thumbnail) }}" class="w-24 h-auto rounded-md" alt="{{ $trx->course->name }}">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $trx->course->name }}</h2>
                        <p class="text-gray-600">Rp {{ number_format($trx->amount, 0, ',', '.') }}</p>
                        <span class="inline-block mt-1 px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">{{ strtoupper($trx->status) }}</span>
                    </div>
                </div>
                <a href="{{ route('student.transaction.show', $trx->id) }}" class="border border-gray-300 px-5 py-2 rounded-full hover:bg-gray-100 text-sm">Detail</a>
            </div>
        @endforeach
    </div>
@endsection
