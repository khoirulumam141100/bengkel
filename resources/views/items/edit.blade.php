@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-edit"></i> Edit Barang</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-box"></i> Detail Barang
            </div>
            <div class="card-body">
                <form action="{{ route('items.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $item->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="buy_price" class="form-label">Harga Beli</label>
                        <input type="number" class="form-control" id="buy_price" name="buy_price" step="0.01" min="0" value="{{ $item->buy_price }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sell_price" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" id="sell_price" name="sell_price" step="0.01" min="0" value="{{ $item->sell_price }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ $item->stock }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Barang
                    </button>
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
