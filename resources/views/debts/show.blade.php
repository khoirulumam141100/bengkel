@extends('layouts.app')

@section('title', 'Detail Hutang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Hutang</h3>
                    <div class="float-end">
                        <a href="{{ route('debts.edit', $debt) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('debts.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Nama Debitur:</th>
                                    <td>{{ $debt->debtor_name }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi:</th>
                                    <td>{{ $debt->description }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Hutang:</th>
                                    <td>Rp {{ number_format($debt->amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Hutang:</th>
                                    <td>{{ $debt->debt_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Jatuh Tempo:</th>
                                    <td>{{ $debt->due_date ? $debt->due_date->format('d/m/Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $debt->status == 'lunas' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $debt->status == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat:</th>
                                    <td>{{ $debt->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diupdate:</th>
                                    <td>{{ $debt->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
