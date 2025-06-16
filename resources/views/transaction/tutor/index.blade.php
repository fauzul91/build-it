@extends('layouts.dashboard')

@section('placeholder')
    Cari transaksi terkini...
@endsection

@section('content')
    <h1 class="text-2xl font-bold mb-1.5">Transactions</h1>
    <p class="opacity-70 mb-8">Pantau histori transaksi di platform.</p>

    <div class="flex flex-col items-center w-full bg-white rounded-2xl shadow-sm mt-8">
        @forelse ($transactions as $transaction)
            <div class="flex items-center w-full justify-between p-8 gap-4">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $transaction->course->thumbnail) }}" alt="Thumbnail Course"
                        class="w-40 h-auto rounded-xl object-cover">
                    <div class="flex flex-col w-full max-w-xs gap-2">
                        <h1 class="text-lg font-semibold break-words text-left">
                            {{ $transaction->course->name }}
                        </h1>
                        <p class="text-font text-sm opacity-70">{{ $transaction->course->category->name ?? 'N/A' }}</p>
                        <p class="text-font text-sm opacity-70">Pembeli: {{ $transaction->user->name }}</p>
                        <p class="text-font text-sm">Status:
                            <span class="font-semibold text-green-600">{{ strtoupper($transaction->status) }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('tutor.transaction.show', $transaction->id) }}"
                        class="flex items-center px-6 py-3 text-white bg-font rounded-full hover:opacity-90 transition-colors">
                        <span class="font-medium">Detail</span>
                    </a>
                </div>
            </div>
        @empty
            <p class="p-8">Belum ada transaksi yang tercatat.</p>
        @endforelse
    </div>
    @if ($transactions->hasPages())
        <div class="mt-8 flex-col justify-center">
            {{ $transactions->links() }}
        </div>
    @endif
@endsection