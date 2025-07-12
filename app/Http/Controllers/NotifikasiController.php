<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function adminIndex()
    {
        $admin = Auth::guard('admin')->user();
        $notifications = $admin->notifications;

        $admin->unreadNotifications->markAsRead();

        return view('admin.notifikasi.index', compact('notifications'));
    }
    
}
