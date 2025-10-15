@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1><i class="fas fa-edit"></i> Edit Modal Awal</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-money-bill-wave"></i> Detail Modal Awal
            </div>
            <div class="card-body">
                <form action="{{ route('capitals.update', $capital) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="initial_capital" class="form-label">Jumlah Modal</label>
                        <input type="number" class="form-control" id="initial_capital" name="initial_capital" step="0.01" min="0" value="{{ $capital->initial_capital }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $capital->start_date }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Modal
                    </button>
                    <a href="{{ route('capitals.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
