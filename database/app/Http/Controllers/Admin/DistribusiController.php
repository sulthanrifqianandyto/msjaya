<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    public function index()
{
    $distribusi = \App\Models\Distribusi::all();
    return view('admin.distribusi.index', compact('distribusi'));
}
}
