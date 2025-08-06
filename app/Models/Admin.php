<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    
    protected $guard = 'admin'; // Gunakan guard admin
    protected $table = 'admins'; // Wajib, karena nama tabel tidak sesuai default
        protected $primaryKey = 'id_admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
}
