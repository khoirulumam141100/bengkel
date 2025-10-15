@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-eye"></i> Detail Jasa</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-wrench"></i> Jasa #{{ $service->id }}
            </div>
            <div class="card-body">
                <p><strong>Nama Jasa:</strong> {{ $service->name }}</p>
                <p><strong>Deskripsi:</strong> {{ $service->description ?? '-' }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                <a href="{{ route('services.edit', $service) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
