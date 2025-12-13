<?php
namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori','supplier')->paginate(15);
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        return view('barang.create', compact('kategori','supplier'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'=>'required',
            'kategori_id'=>'required',
            'harga_beli'=>'required|integer',
            'harga_jual'=>'required|integer',
            'supplier_id'=>'nullable',
            'satuan'=>'required',
            'stok'=>'nullable|integer'
        ]);
        $data['stok'] = $data['stok'] ?? 0;
        Barang::create($data);
        return redirect()->route('barang.index')->with('success','Barang ditambah');
    }

    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        return view('barang.edit', compact('barang','kategori','supplier'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama'=>'required',
            'kategori_id'=>'required',
            'harga_beli'=>'required|integer',
            'harga_jual'=>'required|integer',
            'supplier_id'=>'nullable',
            'satuan'=>'required',
            'stok'=>'nullable|integer'
        ]);
        $barang->update($data);
        return redirect()->route('barang.index')->with('success','Barang diperbarui');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return back()->with('success','Barang dihapus');
    }
}
