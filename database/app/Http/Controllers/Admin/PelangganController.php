<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
{
    $pelanggan = \App\Models\Pelanggan::all();
    return view('admin.pelanggan.index', compact('pelanggan'));
}
    //
}
