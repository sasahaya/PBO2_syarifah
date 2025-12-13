<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi; // pastikan ada model transaksi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total barang
        $total_barang = Barang::count();

        // Stok habis / rendah
        $stok_habis = Barang::where('stok', '<=', 5)->count();
        $low_stock_items = Barang::where('stok', '<=', 5)->get();

        // Total kategori
        $kategori_count = Kategori::count();

        // ==========================
        // 📌 TRANSAKSI PER BULAN
        // ==========================
        $transaksi = Transaksi::select(
            DB::raw("MONTH(created_at) as bulan"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        // Label bulan (Januari, Februari, ... )
        $bulan_nama = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        $transaksi_bulanan_labels = $transaksi->map(function ($t) use ($bulan_nama) {
            return $bulan_nama[$t->bulan];
        });

        $transaksi_bulanan_values = $transaksi->pluck('total');

        // RETURN KE VIEW
        return view('admin.dashboard', compact(
            'total_barang',
            'stok_habis',
            'low_stock_items',
            'kategori_count',
            'transaksi_bulanan_labels',
            'transaksi_bulanan_values'
        ));
    }
}
