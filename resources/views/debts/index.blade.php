@extends('layouts.app')

@section('title', 'Data Hutang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Hutang</h3>
                    <a href="{{ route('debts.create') }}" class="btn btn-primary btn-sm float-end">
                        <i class="fas fa-plus"></i> Tambah Hutang
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Debitur</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Hutang</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($debts as $index => $debt)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $debt->debtor_name }}</td>
                                        <td>{{ Str::limit($debt->description, 50) }}</td>
                                        <td>Rp {{ number_format($debt->amount, 0, ',', '.') }}</td>
                                        <td>{{ $debt->debt_date->format('d/m/Y') }}</td>
                                        <td>{{ $debt->due_date ? $debt->due_date->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            <span class="badge {{ $debt->status == 'lunas' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $debt->status == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('debts.show', $debt) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('debts.edit', $debt) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('debts.destroy', $debt) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus hutang ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data hutang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
