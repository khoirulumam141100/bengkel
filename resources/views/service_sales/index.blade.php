@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-handshake"></i> Daftar Penjualan Jasa</h1>
            <a href="{{ route('service_sales.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Penjualan Jasa
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list"></i> Daftar Penjualan Jasa
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jasa</th>
                                <th>Jumlah</th>
                                <th>Harga per Jasa</th>
                                <th>Total Pendapatan</th>
                                <th>Tanggal Jasa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($serviceSales as $service_sale)
                                <tr>
                                    <td>{{ $service_sale->service->name }}</td>
                                    <td>{{ $service_sale->quantity }}</td>
                                    <td>Rp {{ number_format($service_sale->price, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($service_sale->total_revenue, 0, ',', '.') }}</td>
                                    <td>{{ $service_sale->service_date }}</td>
                                    <td>
                                        <a href="{{ route('service_sales.show', $service_sale) }}" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('service_sales.edit', $service_sale) }}" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('service_sales.destroy', $service_sale) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada penjualan jasa ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
