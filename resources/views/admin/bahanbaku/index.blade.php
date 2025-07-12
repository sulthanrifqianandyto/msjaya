@extends('layouts.admin')

@section('title', 'Bahan Baku')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Data Bahan Baku</h2>

<div style="margin-bottom: 1.5rem; text-align: right;">
    <a href="{{ route('admin.bahanbaku.create') }}" 
    style="background-color: #A8FF3E; color: #111111; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-weight: bold;">
        + Tambah Bahan Baku
    </a>
</div>

@if (session('success'))
    <div style="background-color: #dcedc8; color: #33691e; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem; text-align: left;">Nama Bahan</th>
                <th style="padding: 0.75rem; text-align: left;">Stok</th>
                <th style="padding: 0.75rem; text-align: left;">Satuan</th>
                <th style="padding: 0.75rem; text-align: left;">Tanggal Masuk</th>
                <th style="padding: 0.75rem; text-align: left;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bahanbaku as $item)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $item->nama_bahan }}</td>
                    <td style="padding: 0.75rem;">{{ $item->stok }}</td>
                    <td style="padding: 0.75rem;">{{ $item->satuan }}</td>
                    <td style="padding: 0.75rem;">{{ $item->tanggal_masuk }}</td>
                    <td style="padding: 0.75rem;">
                        <a href="{{ route('admin.bahanbaku.edit', $item->id_bahan) }}"
                            style="color: #1B5E20; font-weight: bold; margin-right: 1rem; text-decoration: none;">
                            Edit
                        </a>

                        <form action="{{ route('admin.bahanbaku.destroy', $item->id_bahan) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus bahan ini?')" 
                                        style="color: #D32F2F; background: none; border: none; cursor: pointer; font-weight: bold;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 1rem; text-align: center; color: #666;">
                        Tidak ada data bahan baku.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
