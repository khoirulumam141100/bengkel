@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-eye"></i> Detail Penjualan</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-cash-register"></i> Penjualan #{{ $sale->id }}
            </div>
            <div class="card-body">
                <p><strong>Barang:</strong> {{ $sale->item->name }}</p>
                <p><strong>Jumlah:</strong> {{ $sale->quantity }}</p>
                <p><strong>Harga Jual per Unit:</strong> Rp {{ number_format($sale->sell_price, 0, ',', '.') }}</p>
                <p><strong>Total Pendapatan:</strong> Rp {{ number_format($sale->total_revenue, 0, ',', '.') }}</p>
                <p><strong>Tanggal Penjualan:</strong> {{ $sale->sale_date }}</p>
                <a href="{{ route('sales.edit', $sale) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
