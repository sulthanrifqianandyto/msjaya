<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
    'nama',
    'tanggal_mulai',
    'tanggal_selesai',
    'target',
    'status',
];
}
