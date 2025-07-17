<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    // App\Models\Pesanan.php

protected $fillable = [
    'pelanggan_id', 'item', 'kuantitas', 'alamat', 'status',
    'provinsi_id', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id'
];




    public function pelanggan()
    {
            return $this->belongsTo(\App\Models\Pelanggan::class, 'pelanggan_id', 'id_pelanggan');
    }
    public function distribusi()
{
    return $this->hasOne(Distribusi::class, 'pesanan_id');
}


}

