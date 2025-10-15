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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-pie"></i> Distribusi Pendapatan
            </div>
            <div class="card-body">
                <canvas id="revenueChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Analisis Keuangan Komprehensif
            </div>
            <div class="card-body">
                <canvas id="financialChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-area"></i> Tren Keuangan Dinamis
            </div>
            <div class="card-body">
                <canvas id="trendChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-donut"></i> Perbandingan Modal vs Laba
            </div>
            <div class="card-body">
                <canvas id="comparisonChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-line"></i> Proyeksi Pertumbuhan
            </div>
            <div class="card-body">
                <canvas id="growthChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Distribution Chart - Enhanced Doughnut
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'doughnut',
        data: {
            labels: ['Penjualan Barang', 'Penjualan Jasa', 'Modal Awal'],
            datasets: [{
                data: [{{ $totalSales }}, {{ $totalServiceSales }}, {{ $capital }}],
                backgroundColor: [
                    'rgba(255, 107, 53, 0.9)',
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(75, 192, 192, 0.9)'
                ],
                borderColor: [
                    'rgba(255, 107, 53, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 3,
                hoverBorderWidth: 5,
                hoverBorderColor: '#fff',
                hoverBackgroundColor: [
                    'rgba(255, 107, 53, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp ' + context.parsed.toLocaleString('id-ID');
                            return label;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // Financial Analysis Chart - Enhanced Bar
    const financialCtx = document.getElementById('financialChart').getContext('2d');
    const financialChart = new Chart(financialCtx, {
        type: 'bar',
        data: {
            labels: ['Modal Awal', 'Pembelian', 'Penjualan', 'Laba Kotor', 'Laba Bersih'],
            datasets: [{
                label: 'Nilai (Rp)',
                data: [{{ $capital }}, {{ $totalPurchases }}, {{ $totalSales + $totalServiceSales }}, {{ $grossProfit }}, {{ $netProfit }}],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                hoverBackgroundColor: [
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
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
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Trend Chart - Area Chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Modal Awal', 'Pembelian', 'Penjualan', 'Laba Kotor', 'Laba Bersih'],
            datasets: [{
                label: 'Tren Keuangan',
                data: [{{ $capital }}, {{ $totalPurchases }}, {{ $totalSales + $totalServiceSales }}, {{ $grossProfit }}, {{ $netProfit }}],
                backgroundColor: 'rgba(255, 107, 53, 0.3)',
                borderColor: 'rgba(255, 107, 53, 1)',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(255, 107, 53, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 8,
                pointHoverRadius: 12,
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 107, 53, 1)',
                pointHoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
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
            },
            animation: {
                duration: 2500,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Comparison Chart - Radar
    const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');
    const comparisonChart = new Chart(comparisonCtx, {
        type: 'radar',
        data: {
            labels: ['Modal Awal', 'Laba Bersih'],
            datasets: [{
                label: 'Modal',
                data: [{{ $capital }}, 0],
                backgroundColor: 'rgba(255, 206, 86, 0.3)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 3,
                pointBackgroundColor: 'rgba(255, 206, 86, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6
            }, {
                label: 'Laba Bersih',
                data: [0, {{ $netProfit }}],
                backgroundColor: 'rgba(153, 102, 255, 0.3)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 3,
                pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    angleLines: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    pointLabels: {
                        color: '#fff',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp ' + context.parsed.r.toLocaleString('id-ID');
                            return label;
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Growth Chart - Line with Projections
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    const currentNetProfit = {{ $netProfit }};
    const projectedGrowth = currentNetProfit * 1.2; // 20% growth projection
    const growthChart = new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: ['Bulan Ini', 'Proyeksi Bulan Depan'],
            datasets: [{
                label: 'Laba Bersih',
                data: [currentNetProfit, projectedGrowth],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 8,
                pointHoverRadius: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
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
            },
            animation: {
                duration: 2500,
                easing: 'easeInOutQuart'
            }
        }
    });
</script>
@endsection
