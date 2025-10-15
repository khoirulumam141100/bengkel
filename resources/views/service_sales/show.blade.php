@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-eye"></i> Detail Penjualan Jasa</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-handshake"></i> Penjualan Jasa #{{ $service_sale->id }}
            </div>
            <div class="card-body">
                <p><strong>Jasa:</strong> {{ $service_sale->service->name }}</p>
                <p><strong>Jumlah:</strong> {{ $service_sale->quantity }}</p>
                <p><strong>Harga per Jasa:</strong> Rp {{ number_format($service_sale->price, 0, ',', '.') }}</p>
                <p><strong>Total Pendapatan:</strong> Rp {{ number_format($service_sale->total_revenue, 0, ',', '.') }}</p>
                <p><strong>Tanggal Jasa:</strong> {{ $service_sale->service_date }}</p>
                <a href="{{ route('service_sales.edit', $service_sale) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('service_sales.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
