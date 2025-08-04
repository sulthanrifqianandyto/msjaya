<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Admin::where('role', 'staff')->get();
        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.staff.create');
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
            'role' => 'staff',
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $staff = Admin::findOrFail($id);
        if ($staff->role !== 'staff') abort(403);
        $staff->delete();
        return back()->with('success', 'Staff berhasil dihapus.');
    }
}
