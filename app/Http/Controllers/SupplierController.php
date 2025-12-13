<?php
namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::paginate(20);
        return view('supplier.index', compact('supplier'));
    }

    public function create(){ return view('supplier.create'); }

    public function store(Request $r){
        $r->validate(['nama'=>'required']);
        Supplier::create($r->all());
        return redirect()->route('supplier.index')->with('success','Supplier ditambah');
    }

    public function edit(Supplier $supplier){ return view('supplier.edit', compact('supplier')); }

    public function update(Request $r, Supplier $supplier){
        $r->validate(['nama'=>'required']);
        $supplier->update($r->all());
        return redirect()->route('supplier.index')->with('success','Supplier diperbarui');
    }

    public function destroy(Supplier $supplier){
        $supplier->delete();
        return back()->with('success','Supplier dihapus');
    }
}
