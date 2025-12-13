<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Petshop Admin' }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset("images/Cute Cats.jpg") }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        /* Overlay supaya konten tetap terbaca */
        .bg-overlay {
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(3px);
            min-height: 100vh;
            width: 100%;
        }

        /* Sidebar ---------------------------------------------------- */
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100vh;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            padding: 25px 20px;
            border-radius: 0 20px 20px 0;
        }

        .sidebar h4 {
            font-weight: 700;
            color: #6C63FF;
        }

        .menu a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 12px;
            font-weight: 500;
            color: #333;
            background: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: 0.25s;
        }

        .menu a:hover,
        .menu .active {
            background: #6C63FF;
            color: white !important;
        }

        /* Konten ---------------------------------------------------- */
        .content {
            margin-left: 270px;
            padding: 30px;
        }

        /* Card efek kaca */
        .card, .modern-card, .chart-box {
            background: rgba(255,255,255,0.85) !important;
            backdrop-filter: blur(6px);
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border: none;
        }
    </style>

    @stack('css')
</head>

<body>
<div class="bg-overlay">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4><i class="bi bi-shop"></i> Petshop</h4>

        <div class="menu mt-4">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="/barang" class="{{ request()->is('barang*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Barang
            </a>

            <a href="/kategori" class="{{ request()->is('kategori*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori
            </a>

            <a href="/supplier" class="{{ request()->is('supplier*') ? 'active' : '' }}">
                <i class="bi bi-truck"></i> Supplier
            </a>

            <a href="/transaksi" class="{{ request()->is('transaksi*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data"></i> Transaksi
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h3 class="text-white">{{ $title ?? '' }}</h3>
        @yield('content')
    </div>

</div> <!-- bg overlay -->

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')
</body>
</html>
