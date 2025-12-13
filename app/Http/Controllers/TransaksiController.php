<?php
namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('barang')->latest()->paginate(30);
        $barang = Barang::all();
        return view('transaksi.index', compact('transaksi','barang'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'barang_id'=>'required|integer',
            'jenis'=>'required|in:masuk,keluar',
            'jumlah'=>'required|integer|min:1',
            'keterangan'=>'nullable'
        ]);

        $barang = Barang::findOrFail($r->barang_id);

        if ($r->jenis == 'masuk') {
            $barang->stok += $r->jumlah;
        } else {
            if ($barang->stok < $r->jumlah) {
                return back()->with('error','Stok tidak mencukupi');
            }
            $barang->stok -= $r->jumlah;
        }
        $barang->save();

        Transaksi::create($r->all());
        return back()->with('success','Transaksi tersimpan');
    }
}
