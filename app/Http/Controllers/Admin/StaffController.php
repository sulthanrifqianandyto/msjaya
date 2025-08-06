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
        if (auth()->user()->role !== 'admin') {
        abort(403, 'Akses ditolak.');
    }
        $staffs = Admin::where('role', 'staff')->get();

        return view('admin.staff.index', compact('staffs'));

    }

    public function create()
{
    $staff = new Admin();
    return view('admin.staff.create', compact('staff')); // sesuaikan path view
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

    public function edit($id)
{
    // Ambil berdasarkan id_admin dan role = 'staff'
    $staff = Admin::where('role', 'staff')->where('id_admin', $id)->firstOrFail();
    return view('admin.staff.edit', compact('staff'));
}



public function update(Request $request, $id)
{
    // Ambil berdasarkan id_admin dan role = 'staff'
    $staff = Admin::where('role', 'staff')->where('id_admin', $id)->firstOrFail();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email,' . $staff->id_admin . ',id_admin',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $staff->name = $request->name;
    $staff->email = $request->email;

    if ($request->filled('password')) {
        $staff->password = Hash::make($request->password);
    }

    $staff->save();

    return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil diperbarui.');
}



    public function destroy($id)
    {
        $staff = Admin::findOrFail($id);
        if ($staff->role !== 'staff') abort(403);
        $staff->delete();
        return back()->with('success', 'Staff berhasil dihapus.');
    }
}
