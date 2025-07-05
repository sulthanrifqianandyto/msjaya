<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $table = 'distribusi';
    protected $primaryKey = 'id_distribusi';
    protected $fillable = ['pesanan_id', 'id_pelanggan', 'jumlah', 'tanggal_distribusi', 'status'];

    public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
}
public function pesanan()
{
    return $this->belongsTo(Pesanan::class, 'pesanan_id');
}

}
