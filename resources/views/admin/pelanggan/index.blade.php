@extends('layouts.admin')

@section('title', 'Pelanggan')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Data Pelanggan</h2>

<div style="margin-bottom: 1.5rem; text-align: right;">
    <a href="{{ route('admin.pelanggan.create') }}" 
    style="background-color: #A8FF3E; color: #111111; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-weight: bold;">
        + Tambah Pelanggan
    </a>
</div>

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem; text-align: left;">Nama</th>
                <th style="padding: 0.75rem; text-align: left;">Email</th>
                <th style="padding: 0.75rem; text-align: left;">Alamat</th>
                <th style="padding: 0.75rem; text-align: left;">No HP</th>
                <th style="padding: 0.75rem; text-align: left;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelanggan as $item)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $item->nama }}</td>
                    <td style="padding: 0.75rem;">{{ $item->email }}</td>
                    <td style="padding: 0.75rem;">{{ $item->alamat }}</td>
                    <td style="padding: 0.75rem;">{{ $item->no_hp }}</td>
                    <td style="padding: 0.75rem;">
                        <a href="{{ route('admin.pelanggan.edit', ['pelanggan' => $item->id_pelanggan]) }}"
                            style="color: #1B5E20; font-weight: bold; margin-right: 1rem; text-decoration: none;">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.pelanggan.destroy', $item->id_pelanggan) }}" style="display:inline;">
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
                    <td colspan="5" style="padding: 1rem; text-align: center; color: #666;">Tidak ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
