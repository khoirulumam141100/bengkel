@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-plus"></i> Tambah Penjualan</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-cash-register"></i> Detail Penjualan
            </div>
            <div class="card-body">
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="item_id" class="form-label">Barang</label>
                        <select class="form-select" id="item_id" name="item_id" required>
                            <option value="">Pilih Barang</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" data-stock="{{ $item->stock }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="sell_price" class="form-label">Harga Jual per Unit</label>
                        <input type="number" class="form-control" id="sell_price" name="sell_price" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="sale_date" class="form-label">Tanggal Penjualan</label>
                        <input type="date" class="form-control" id="sale_date" name="sale_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Penjualan
                    </button>
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
