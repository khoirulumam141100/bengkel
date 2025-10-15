@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-eye"></i> Detail Modal Awal</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-money-bill-wave"></i> Modal Awal #{{ $capital->id }}
            </div>
            <div class="card-body">
                <p><strong>Jumlah Modal:</strong> Rp {{ number_format($capital->initial_capital, 0, ',', '.') }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ $capital->start_date }}</p>
                <a href="{{ route('capitals.edit', $capital) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('capitals.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
