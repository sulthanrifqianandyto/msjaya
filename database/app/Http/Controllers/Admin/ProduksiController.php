<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index()
{
    $produksi = \App\Models\Produksi::all();
    return view('admin.produksi.index', compact('produksi'));
}
}
