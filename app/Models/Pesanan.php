<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
    'pelanggan_id',
    'item',
    'kuantitas',
    'alamat',
    'status',
    'bukti_foto', // ← tambahkan ini
];


    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function distribusi()
{
    return $this->hasOne(Distribusi::class, 'pesanan_id');
}

}

