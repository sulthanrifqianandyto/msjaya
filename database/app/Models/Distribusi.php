<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $table = 'distribusi';
    protected $fillable = ['jumlah', 'status', 'tanggal_distribusi'];
}
