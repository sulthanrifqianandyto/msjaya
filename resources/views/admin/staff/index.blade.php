@extends('layouts.admin')

@section('title', 'Staff')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Data Staff</h2>

<div style="margin-bottom: 1.5rem; text-align: right;">
    <a href="{{ route('admin.staff.create') }}" 
    style="background-color: #A8FF3E; color: #111111; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-weight: bold;">
        + Tambah Staff
    </a>
</div>

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem; text-align: left;">Nama</th>
                <th style="padding: 0.75rem; text-align: left;">Email</th>
                <th style="padding: 0.75rem; text-align: left;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($staffs as $staff)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $staff->name }}</td>
                    <td style="padding: 0.75rem;">{{ $staff->email }}</td>
                    <td style="padding: 0.75rem;">
                        <a href="{{ route('admin.staff.edit', ['staff' => $staff->id_admin]) }}">Edit</a>

                        <form method="POST" action="{{ route('admin.staff.destroy', ['staff' => $staff->id_admin]) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                    style="color: #D32F2F; background: none; border: none; cursor: pointer; font-weight: bold;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="padding: 1rem; text-align: center; color: #666;">Tidak ada data staff.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
