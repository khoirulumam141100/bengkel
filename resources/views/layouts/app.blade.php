<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #2c2c2c;
            border-bottom: 2px solid #ff6b35;
        }
        .navbar-brand {
            color: #ff6b35 !important;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: #ffffff !important;
        }
        .navbar-nav .nav-link:hover {
            color: #ff6b35 !important;
        }
        .card {
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #ffffff;
        }
        .card-header {
            background-color: #333;
            border-bottom: 1px solid #444;
            color: #ff6b35;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #ff6b35;
            border-color: #ff6b35;
        }
        .btn-primary:hover {
            background-color: #e55a2b;
            border-color: #e55a2b;
        }
        .btn-secondary {
            background-color: #444;
            border-color: #444;
        }
        .btn-secondary:hover {
            background-color: #555;
            border-color: #555;
        }
        .table {
            color: #ffffff;
        }
        .table thead th {
            background-color: #333;
            border-color: #444;
            color: #ff6b35;
        }
        .table tbody tr {
            background-color: #2c2c2c;
        }
        .table tbody tr:hover {
            background-color: #333;
        }
        .form-control {
            background-color: #333;
            border: 1px solid #444;
            color: #ffffff;
        }
        .form-control:focus {
            background-color: #333;
            border-color: #ff6b35;
            color: #ffffff;
        }
        .form-select {
            background-color: #333;
            border: 1px solid #444;
            color: #ffffff;
        }
        .form-select:focus {
            background-color: #333;
            border-color: #ff6b35;
            color: #ffffff;
        }
        .alert-success {
            background-color: #28a745;
            border-color: #28a745;
            color: #ffffff;
        }
        .alert-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
        }
        .sidebar {
            background-color: #2c2c2c;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #ffffff;
            margin-bottom: 10px;
        }
        .sidebar .nav-link:hover {
            color: #ff6b35;
        }
        .sidebar .nav-link.active {
            color: #ff6b35;
            font-weight: bold;
        }
        .content {
            padding: 20px;
        }
        .stat-card {
            background-color: #2c2c2c;
            border: 1px solid #444;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .stat-card h3 {
            color: #ff6b35;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .stat-card p {
            color: #ffffff;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-tools"></i> Manajemen Bengkel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('items.index') }}"><i class="fas fa-box"></i> Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('purchases.index') }}"><i class="fas fa-shopping-cart"></i> Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sales.index') }}"><i class="fas fa-cash-register"></i> Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services.index') }}"><i class="fas fa-wrench"></i> Jasa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('service_sales.index') }}"><i class="fas fa-handshake"></i> Penjualan Jasa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('capitals.index') }}"><i class="fas fa-money-bill-wave"></i> Modal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('debts.index') }}"><i class="fas fa-credit-card"></i> Hutang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
