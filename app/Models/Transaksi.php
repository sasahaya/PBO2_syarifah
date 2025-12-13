<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['barang_id','jenis','jumlah','keterangan'];

    public function barang() {
        return $this->belongsTo(Barang::class);
    }
}
