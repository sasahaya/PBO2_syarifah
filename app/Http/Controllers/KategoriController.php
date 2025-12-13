<?php
namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::paginate(20);
        return view('kategori.index', compact('kategori'));
    }

    public function create(){ return view('kategori.create'); }

    public function store(Request $r){
        $r->validate(['nama'=>'required']);
        Kategori::create($r->all());
        return redirect()->route('kategori.index')->with('success','Kategori ditambah');
    }

    public function edit(Kategori $kategori){ return view('kategori.edit', compact('kategori')); }

    public function update(Request $r, Kategori $kategori){
        $r->validate(['nama'=>'required']);
        $kategori->update($r->all());
        return redirect()->route('kategori.index')->with('success','Kategori diperbarui');
    }

    public function destroy(Kategori $kategori){
        $kategori->delete();
        return back()->with('success','Kategori dihapus');
    }
}
