@extends('layouts.app')

@section('content')
    <h1 class="text-center text-3xl font-bold my-8">Menyambungkan ke Midtrans...</h1>
@endsection

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            alert("Pembayaran berhasil!");
            window.location.href = "/kelas";
        },
        onPending: function(result) {
            alert("Pembayaran tertunda.");
            window.location.href = "/kelas";
        },
        onError: function(result) {
            alert("Pembayaran gagal.");
        },
        onClose: function() {
            alert('Kamu menutup pop-up tanpa menyelesaikan pembayaran.');
        }
    });
</script>
