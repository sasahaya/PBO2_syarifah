<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'nama', 'kategori_id', 'stok', 'harga_beli',
        'harga_jual', 'supplier_id', 'satuan'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function transaksi() {
        return $this->hasMany(Transaksi::class);
    }
}
