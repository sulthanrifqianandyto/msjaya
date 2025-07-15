@extends('layouts.admin')

@section('title', 'Tambah Produksi')

@section('content')
<h2 style="color: #14532D; margin-bottom: 1rem;">Tambah Produksi</h2>

<div style="background-color: #F0FDF4; padding: 2rem; border-radius: 12px; max-width: 700px;">
    <form action="{{ route('admin.produksi.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #14532D;">Nama Produk</label>
            <select name="nama_produk" class="form-control"
                    style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
                <option value="">-- Pilih Produk --</option>
                <option value="beras organik">Beras Organik</option>
                <option value="beras medium">Beras Medium</option>
                <option value="beras premium">Beras Premium</option>
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
    <label style="display:block; font-weight: bold; color: #14532D;">Stok (kg)</label>
    <div style="display: flex; align-items: center;">
        <input type="number" name="stok" step="0.01" min="0" value="{{ old('stok', $produksi->stok ?? '') }}"
               style="flex: 1; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px 0 0 6px;" required>
        <span style="background-color: #14532D; color: #fff; padding: 0.5rem 1rem; border-radius: 0 6px 6px 0;">kg</span>
    </div>
</div>


        <div style="margin-bottom: 1.5rem;">
            <label style="display:block; font-weight: bold; color: #14532D;">Tanggal Produksi</label>
            <input type="date" name="tanggal_produksi" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
        </div>

        <button type="submit"
                style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: bold;">
            Simpan
        </button>
    </form>
</div>
@endsection
