<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Petshop Admin' }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset("images/Cute Cats.jpg") }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .overlay {
            background: rgba(0,0,0,0.35);
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            position: fixed;
            height: 100vh;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(8px);
            padding: 25px 20px;
            border-radius: 0 20px 20px 0;
        }

        .sidebar h4 {
            font-weight: 700;
            color: #6C63FF;
        }

        .menu a,
        .menu button {
            display: block;
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 12px;
            font-weight: 500;
            color: #333;
            background: rgba(255,255,255,0.7);
            text-decoration: none;
            border: none;
            text-align: left;
            transition: 0.25s;
        }

        .menu a:hover,
        .menu a.active {
            background: #6C63FF;
            color: white;
        }

        .menu button:hover {
            background: #FF5F7E;
            color: white;
        }

        .content {
            margin-left: 280px;
            padding: 30px;
        }
    </style>

    @stack('css')
</head>

<body>
<div class="overlay">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4><i class="bi bi-shop"></i> Petshop</h4>

        <div class="menu mt-4">

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('barang.index') }}"
               class="{{ request()->is('admin/barang*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Barang
            </a>

            <a href="{{ route('kategori.index') }}"
               class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori
            </a>

            <a href="{{ route('supplier.index') }}"
               class="{{ request()->is('admin/supplier*') ? 'active' : '' }}">
                <i class="bi bi-truck"></i> Supplier
            </a>

            <a href="{{ route('transaksi.index') }}"
               class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data"></i> Transaksi
            </a>

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" onclick="return confirm('Yakin ingin logout?')">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h3 class="text-white mb-4">{{ $title ?? '' }}</h3>
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('js')
</body>
</html>
