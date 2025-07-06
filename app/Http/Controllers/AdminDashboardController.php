<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\StatusPesananBerubah;

class AdminDashboardController extends Controller
{
    public function index()
{
    $notifications = auth()->user()->notifications;

    return view('admin.dashboard', compact('notifications'));
}


}
