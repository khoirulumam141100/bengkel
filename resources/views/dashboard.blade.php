@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <h3>Rp {{ number_format($capital, 0, ',', '.') }}</h3>
            <p>Modal Awal</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <h3>Rp {{ number_format($totalPurchases, 0, ',', '.') }}</h3>
            <p>Total Pembelian</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <h3>Rp {{ number_format($totalSales + $totalServiceSales, 0, ',', '.') }}</h3>
            <p>Total Penjualan</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <h3>Rp {{ number_format($totalServicesRevenue, 0, ',', '.') }}</h3>
            <p>Total Harga Jasa</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="stat-card">
            <h3>Rp {{ number_format($grossProfit, 0, ',', '.') }}</h3>
            <p>Laba Kotor</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <h3>Rp {{ number_format($netProfit, 0, ',', '.') }}</h3>
            <p>Laba Bersih</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-line"></i> Ringkasan Keuangan
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><strong>Modal Awal</strong></td>
                            <td>Rp {{ number_format($capital, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Pembelian Barang</strong></td>
                            <td>Rp {{ number_format($totalPurchases, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Penjualan Barang</strong></td>
                            <td>Rp {{ number_format($totalSales, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Penjualan Jasa</strong></td>
                            <td>Rp {{ number_format($totalServiceSales, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Pendapatan</strong></td>
                            <td>Rp {{ number_format($totalSales + $totalServiceSales, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Laba Kotor (Pendapatan - Pembelian)</strong></td>
                            <td>Rp {{ number_format($grossProfit, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Laba Bersih (Laba Kotor - Modal)</strong></td>
                            <td>Rp {{ number_format($netProfit, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-line"></i> Diagram Modal Awal vs Laba Bersih
            </div>
            <div class="card-body">
                <canvas id="profitChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('profitChart').getContext('2d');
    const profitChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Modal Awal', 'Laba Bersih'],
            datasets: [{
                label: 'Nilai (Rp)',
                data: [{{ $capital }}, {{ $netProfit }}],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
