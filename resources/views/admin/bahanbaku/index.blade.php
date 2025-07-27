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

<form method="GET" action="{{ route('admin.bahanbaku.index') }}" class="mb-4">
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">

        <input type="date" name="tanggal_mulai"
            value="{{ request('tanggal_mulai') }}"
            class="form-input rounded-md shadow-sm" />

        <input type="date" name="tanggal_selesai"
            value="{{ request('tanggal_selesai') }}"
            class="form-input rounded-md shadow-sm" />

        <select name="kabupaten_id" class="form-select rounded-md shadow-sm">
            <option value="">-- Semua Kabupaten (Jawa Barat) --</option>
            @foreach($kabupatens as $kabupaten)
                <option value="{{ $kabupaten->id }}" {{ request('kabupaten_id') == $kabupaten->id ? 'selected' : '' }}>
                    {{ $kabupaten->nama }}
                </option>
            @endforeach
        </select>

    </div>

    <div class="mt-3">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Filter</button>
        <a href="{{ route('admin.bahanbaku.index') }}" class="ml-2 text-gray-600 hover:underline">Reset</a>
    </div>
</form>


<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem; text-align: left;">Nama Bahan</th>
                <th style="padding: 0.75rem; text-align: left;">Stok</th>
                <th style="padding: 0.75rem; text-align: left;">Tanggal Masuk</th>
                <th style="padding: 0.75rem; text-align: left;">Alamat Suplier</th>
                <th style="padding: 0.75rem; text-align: left;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bahanbaku as $item)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $item->nama_bahan }}</td>
                    <td style="padding: 0.75rem;">{{ $item->stok }} kg</td>
                    <td style="padding: 0.75rem;">{{ $item->tanggal_masuk }}</td>
                    <td style="padding: 0.75rem;">
                        {{ $item->provinsi->nama ?? '-' }},
                        {{ $item->kabupaten->nama ?? '-' }},
                        {{ $item->kecamatan->nama ?? '-' }},
                        {{ $item->kelurahan->nama ?? '-' }}
                    </td>
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
                    <td colspan="4" style="padding: 1rem; text-align: center; color: #666;">
                        Tidak ada data bahan baku.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
