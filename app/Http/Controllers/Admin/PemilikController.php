<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Admin::where('role', 'pemilik')->get();
        return view('admin.pemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        return view('admin.pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pemilik',
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $pemilik = Admin::findOrFail($id);
        if ($pemilik->role !== 'pemilik') abort(403);
        $pemilik->delete();
        return back()->with('success', 'Pemilik berhasil dihapus.');
    }
}
