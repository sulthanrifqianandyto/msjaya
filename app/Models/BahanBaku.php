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
    'tanggal_masuk',
    'provinsi_id',
    'kabupaten_id',
    'kecamatan_id',
    'kelurahan_id',
    'alamat_suplier',
];


    public function provinsi()
{
    return $this->belongsTo(Provinsi::class);
}

public function kabupaten()
{
    return $this->belongsTo(Kabupaten::class);
}

public function kecamatan()
{
    return $this->belongsTo(Kecamatan::class);
}

public function kelurahan()
{
    return $this->belongsTo(Kelurahan::class);
}

}
