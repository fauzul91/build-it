@extends('layouts.dashboard')

@section('placeholder')
    Cari course terkini...
@endsection

@section('content')
    <div class="mb-10">
        <h1 class="text-2xl font-bold mb-2 tracking-tight">Dashboard Overview</h1>
        <p class="opacity-80">Ringkasan Statistik Aktivitas di BuildIt</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="bg-white rounded-3xl shadow-lg p-7 hover:shadow-md transition-all duration-300 transform">
            <h4 class="text-sm text-gray-500 mb-2 uppercase tracking-wide">Total Revenue</h4>
            <p class="text-3xl font-bold text-gray-900">Rp{{ number_format($totalRevenue / 1000, 0) }}K</p>
        </div>
        <div class="bg-white rounded-3xl shadow-lg p-7 hover:shadow-md transition-all duration-300 transform">
            <h4 class="text-sm text-gray-500 mb-2 uppercase tracking-wide">Total Course</h4>
            <p class="text-3xl font-bold text-gray-900">{{ $totalCourses }}</p>
        </div>
        <div class="bg-white rounded-3xl shadow-lg p-7 hover:shadow-md transition-all duration-300 transform">
            <h4 class="text-sm text-gray-500 mb-2 uppercase tracking-wide">Total Customer</h4>
            <p class="text-3xl font-bold text-gray-900">{{ $totalStudents }}</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-7 mb-10">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Transaksi per Hari</h2>
        <div class="w-full">
            <canvas id="transactionChart" height="300"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-7 overflow-x-auto">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Histori Transaksi Terbaru</h2>
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase text-gray-500 border-b border-gray-200">
                <tr>
                    <th class="py-4 pr-6 font-semibold">Tanggal</th>
                    <th class="py-4 pr-6 font-semibold">User</th>
                    <th class="py-4 pr-6 font-semibold">Course</th>
                    <th class="py-4 pr-6 font-semibold">Total</th>
                    <th class="py-4 pr-6 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentTransactions as $trx)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                        <td class="py-3.5 pr-6">{{ $trx->created_at->format('d M Y') }}</td>
                        <td class="py-3.5 pr-6">{{ $trx->user->name ?? '-' }}</td>
                        <td class="py-3.5 pr-6">{{ $trx->course->name ?? '-' }}</td>
                        <td class="py-3.5 pr-6">Rp{{ number_format($trx->platform_fee) }}</td>
                        <td class="py-3.5">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                @if($trx->status === 'completed')
                                    bg-green-100 text-green-700
                                @elseif($trx->status === 'pending')
                                    bg-yellow-100 text-yellow-700
                                @else 
                                    bg-red-100 text-red-700
                                @endif">
                                {{ ucfirst($trx->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = {
            labels: {!! json_encode($last7Days->pluck('date')) !!},
            datasets: [{
                label: 'Transaksi (Rp)',
                data: {!! json_encode($last7Days->pluck('total')) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.08)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointHoverRadius: 7
            }]
        };

        const config = {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#ffffff',
                        bodyColor: '#e5e7eb',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp' + (context.parsed.y / 1000).toLocaleString() + 'K';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e5e7eb',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            callback: value => 'Rp' + (value / 1000).toLocaleString() + 'K',
                            color: '#6b7280'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: { color: '#6b7280' }
                    }
                }
            }
        };

        new Chart(document.getElementById('transactionChart'), config);
    </script>
@endsection