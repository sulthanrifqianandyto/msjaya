@extends('layouts.admin')

@section('title', 'Distribusi')

@section('content')
    <h2 style="color: #14532D; margin-bottom: 1.5rem;">Data Distribusi</h2>

    <div style="margin-bottom: 1.5rem; text-align: right;">
        <a href="{{ route('admin.distribusi.create') }}"
           style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.2rem; border-radius: 6px; text-decoration: none; font-weight: bold;">
            + Tambah Distribusi
        </a>
    </div>

    @if (session('success'))
        <div style="background-color: #DCFCE7; color: #14532D; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.distribusi.index') }}">
    <label for="kabupaten_id">Filter Kabupaten:</label>
    <select name="kabupaten_id" id="kabupaten_id">
        <option value="">-- Semua Kabupaten --</option>
        @foreach ($kabupatens as $kab)
            <option value="{{ $kab->id }}" {{ request('kabupaten_id') == $kab->id ? 'selected' : '' }}>
                {{ $kab->nama }}
            </option>
        @endforeach
    </select>
    <button type="submit">Terapkan</button>
</form>


    <div style="overflow-x:auto;">
        <table style="width: 100%; border-collapse: collapse; background-color: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden;">
            <thead style="background-color: #14532D; color: white;">
                <tr>
                    <th style="padding: 1rem; text-align: left;">Nama Pelanggan</th>
                    <th style="padding: 1rem; text-align: left;">Kuantitas</th>
                    <th style="padding: 1rem; text-align: left;">Status</th>
                    <th style="padding: 1rem; text-align: left;">Tanggal Distribusi</th>
                    <th style="padding: 1rem; text-align: left;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($distribusi as $item)
                    <tr style="border-bottom: 1px solid #E0E0E0;">
                        <td style="padding: 1rem;">{{ $item->pelanggan->nama }}</td>
                        <td style="padding: 1rem;">{{ $item->jumlah }} kg</td>
                        <td style="padding: 1rem;">{{ $item->status }}</td>
                        <td style="padding: 1rem;">{{ $item->tanggal_distribusi }}</td>
                        <td style="padding: 1rem;">
                            <a href="{{ route('admin.distribusi.edit', $item->id_distribusi) }}"
                            style="color: #1B5E20; font-weight: bold; margin-right: 1rem; text-decoration: none;">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.distribusi.destroy', $item->id_distribusi) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                        style="color: #D32F2F; background: none; border: none; cursor: pointer; font-weight: bold;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 1.5rem; text-align: center; color: #757575;">
                            Tidak ada data distribusi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
