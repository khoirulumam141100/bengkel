@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-eye"></i> Detail Pembelian</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-shopping-cart"></i> Pembelian #{{ $purchase->id }}
            </div>
            <div class="card-body">
                <p><strong>Barang:</strong> {{ $purchase->item->name }}</p>
                <p><strong>Jumlah:</strong> {{ $purchase->quantity }}</p>
                <p><strong>Harga Beli per Unit:</strong> Rp {{ number_format($purchase->buy_price, 0, ',', '.') }}</p>
                <p><strong>Total Biaya:</strong> Rp {{ number_format($purchase->total_cost, 0, ',', '.') }}</p>
                <p><strong>Tanggal Pembelian:</strong> {{ $purchase->purchase_date }}</p>
                <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
