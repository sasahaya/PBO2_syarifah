@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* -------------------------------------- */
    /* GLOBAL & UTILITY */
    /* -------------------------------------- */
    body {
        font-family: 'Poppins', sans-serif;
    }

    .overlay {
        background: rgba(255,255,255,0.8);
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    }

    /* -------------------------------------- */
    /* CARD STYLES */
    /* -------------------------------------- */
    .modern-card {
        border-radius: 18px; 
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
        position: relative;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    /* KELAS WARNA PASTEL */
    .card-blue { 
        background: #E3E7FF; /* Lilac Pastel */
        color: #4B4453; 
    }
    .card-orange { 
        background: #FFE3D2; /* Peach Pastel */
        color: #9C5237; 
    }
    .card-green { 
        background: #DFF8F2; /* Mint Pastel */
        color: #2D6A4F; 
    }
    .bg-white {
        background: white;
        color: #333;
    }

    /* KONTEN KARTU */
    .modern-card .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .modern-card .title {
        font-size: 16px;
        font-weight: 500;
        color: inherit; 
    }

    .modern-card .value {
        font-size: 34px;
        font-weight: 800;
        color: #111;
        line-height: 1;
    }

    /* ICON */
    .icon-wrapper {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 18px;
        opacity: 0.8;
    }
    .card-blue .icon-wrapper { background: #6C63FF; }
    .card-orange .icon-wrapper { background: #FF8A5C; }
    .card-green .icon-wrapper { background: #00C9A7; }
    
    /* -------------------------------------- */
    /* CHART & TABLE STYLES */
    /* -------------------------------------- */
    /* Chart container */
    #stokChart {
        max-height: 150px !important; 
    }

    /* pie chart kecil */
    #pieTransaksi {
        max-width: 250px !important;
        max-height: 250px !important;
        margin: 0 auto;
    }

    /* Tabel */
    .table thead {
        background: #6C63FF;
        color: white;
    }
    .table-bordered {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #ddd;
    }
    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
</style>

<h2 class="mb-4" style="color:#4B4453; font-weight: 700;">Dashboard Utama</h2>

<div class="overlay">

    {{-- CARD ATAS --}}
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="modern-card card-blue">
                <div class="header-content">
                    <div class="title">Total Barang</div>
                    <div class="icon-wrapper"><i class="fas fa-boxes"></i></div>
                </div>
                <div class="value">{{ $total_barang }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="modern-card card-orange">
                <div class="header-content">
                    <div class="title">Stok Rendah (≤ 5)</div>
                    <div class="icon-wrapper"><i class="fas fa-exclamation-triangle"></i></div>
                </div>
                <div class="value">{{ $stok_habis }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="modern-card card-green">
                <div class="header-content">
                    <div class="title">Kategori Aktif</div>
                    <div class="icon-wrapper"><i class="fas fa-tags"></i></div>
                </div>
                <div class="value">{{ $kategori_count ?? 0 }}</div>
            </div>
        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="row">

        <div class="col-md-8 mb-4">
            <div class="modern-card bg-white h-100">
                <h4 class="title mb-3" style="color:#6C63FF;">Grafik Stok Barang Rendah</h4>
                <canvas id="stokChart" height="150"></canvas>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="modern-card bg-white h-100">
                <h4 class="title mb-3" style="color:#6C63FF;">Proporsi Transaksi</h4>
                <canvas id="pieTransaksi"></canvas>
            </div>
        </div>

    </div>

    {{-- TABEL STOCK RENDAH --}}
    <div class="modern-card bg-white mt-2">
        <h4 class="title" style="color:#FF8A5C;"><i class="fas fa-bell me-2"></i> Barang Stok Rendah</h4>

        <table class="table table-bordered mt-3">
            <thead style="background:#6C63FF; color:white;">
                <tr>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse($low_stock_items as $i)
                <tr>
                    <td>{{ $i->nama }}</td>
                    <td><span class="badge bg-warning text-dark">{{ $i->stok }}</span></td>
                    <td>{{ $i->kategori->nama ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center p-3">Semua stok di atas batas minimum. Kerja bagus!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- BAR CHART (Stok Rendah) ---
    const barCtx = document.getElementById('stokChart').getContext('2d');
    
    // Gradient untuk Bar Chart
    const barGradient = barCtx.createLinearGradient(0, 0, 0, 400);
    barGradient.addColorStop(0, 'rgba(108, 99, 255, 1)');
    barGradient.addColorStop(1, 'rgba(108, 99, 255, 0.4)');

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: @json($low_stock_items->pluck('nama')),
            datasets: [{
                label: 'Stok Barang',
                data: @json($low_stock_items->pluck('stok')),
                backgroundColor: barGradient,
                borderColor: '#6C63FF',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { 
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // --- PIE CHART (Transaksi Bulanan) DENGAN ANIMASI ---
    new Chart(document.getElementById('pieTransaksi'), {
        type: 'pie',
        data: {
            labels: @json($transaksi_bulanan_labels),
            datasets: [{
                data: @json($transaksi_bulanan_values),
                backgroundColor: [
                    '#6C63FF',   // Biru Ungu
                    '#FF8A5C',   // Peach
                    '#00C9A7',   // Hijau Teal
                    '#FFC300',   // Kuning
                    '#9966FF',   // Ungu
                    '#FF5F7E',   // Pink
                    '#4BC0C0', 
                    '#FF9F40',
                ],
                borderColor: 'white',
                borderWidth: 3,
                hoverOffset: 10 // Efek pop-out saat di-hover
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: true,
            animation: {
                duration: 1500, // Durasi animasi 'draw' saat dimuat (1.5 detik)
                easing: 'easeInOutQuart' 
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'Poppins', size: 12 }
                    }
                },
                tooltip: {
                    animation: true // Transisi tooltip mulus
                }
            },
            scales: {
                y: { display: false },
                x: { display: false }
            }
        }
    });
</script>

@endsection