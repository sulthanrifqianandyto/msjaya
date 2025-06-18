<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilProduksi extends Model
{
    protected $table = 'hasil_produksi';
    protected $primaryKey = 'id_hasil';

    protected $fillable = ['nama_produk', 'stok', 'satuan', 'tanggal'];
}
