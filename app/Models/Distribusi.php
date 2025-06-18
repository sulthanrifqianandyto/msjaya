<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $table = 'distribusi';
    protected $primaryKey = 'id_distribusi';
    protected $fillable = ['id_pelanggan', 'jumlah', 'tanggal_distribusi'];
    public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
}

}
