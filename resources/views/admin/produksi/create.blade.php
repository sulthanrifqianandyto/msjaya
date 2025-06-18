@extends('layouts.admin')

@section('title', 'Tambah Produksi')

@section('content')
<h2 style="color: #14532D; margin-bottom: 1rem;">Tambah Produksi</h2>

<div style="background-color: #F0FDF4; padding: 2rem; border-radius: 12px; max-width: 700px;">
    <form action="{{ route('admin.produksi.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #14532D;">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #14532D;">Stok</label>
            <input type="number" name="stok" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #14532D;">Satuan</label>
            <input type="text" name="satuan" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
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
