<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin'; // Gunakan guard admin

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // tambahkan role di sini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Helper functions (optional tapi sangat berguna)
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPemilik()
    {
        return $this->role === 'pemilik';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }
}
