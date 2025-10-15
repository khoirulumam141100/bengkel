@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-plus"></i> Tambah Pembelian</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-shopping-cart"></i> Detail Pembelian
            </div>
            <div class="card-body">
                <form action="{{ route('purchases.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="item_id" class="form-label">Barang</label>
                        <select class="form-select" id="item_id" name="item_id" required>
                            <option value="">Pilih Barang</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="buy_price" class="form-label">Harga Beli per Unit</label>
                        <input type="number" class="form-control" id="buy_price" name="buy_price" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Pembelian
                    </button>
                    <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
