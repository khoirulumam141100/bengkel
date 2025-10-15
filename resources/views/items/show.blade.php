@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-eye"></i> Detail Barang</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-box"></i> Barang #{{ $item->id }}
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $item->name }}</p>
                <p><strong>Deskripsi:</strong> {{ $item->description ?? '-' }}</p>
                <p><strong>Harga Beli:</strong> Rp {{ number_format($item->buy_price, 0, ',', '.') }}</p>
                <p><strong>Harga Jual:</strong> Rp {{ number_format($item->sell_price, 0, ',', '.') }}</p>
                <p><strong>Stok:</strong> {{ $item->stock }}</p>
                <a href="{{ route('items.edit', $item) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
