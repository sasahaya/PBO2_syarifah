<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Jika nama tabel sudah "kategori", boleh dihapus
    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    /**
     * Relasi ke Barang
     * 1 kategori punya banyak barang
     */
    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}
