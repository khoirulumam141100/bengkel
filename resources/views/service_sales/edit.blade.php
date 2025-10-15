@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-edit"></i> Edit Penjualan Jasa</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-handshake"></i> Detail Penjualan Jasa
            </div>
            <div class="card-body">
                <form action="{{ route('service_sales.update', $service_sale) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="service_id" class="form-label">Jasa</label>
                        <select class="form-select" id="service_id" name="service_id" required>
                            <option value="">Pilih Jasa</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $service_sale->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="{{ $service_sale->quantity }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga per Jasa</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ $service_sale->price }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="service_date" class="form-label">Tanggal Jasa</label>
                        <input type="date" class="form-control" id="service_date" name="service_date" value="{{ $service_sale->service_date }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Penjualan Jasa
                    </button>
                    <a href="{{ route('service_sales.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
