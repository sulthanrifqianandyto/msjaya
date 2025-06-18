<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    // Ubah ini jika nama tabel sebenarnya adalah `bahan_baku`
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id_bahan';
    public $incrementing = true; // ubah ke false jika tidak auto-increment
    protected $keyType = 'int';

    protected $fillable = [
        'nama_bahan',
        'stok',
        'satuan',
        'tanggal_masuk',
    ];
}
