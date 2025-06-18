@extends('layouts.admin')

@section('title', 'Tambah Bahan Baku')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Tambah Bahan Baku</h2>

<div style="background-color: #FAF9F6; padding: 2rem; border-radius: 12px; max-width: 700px;">
    <form action="{{ route('admin.bahanbaku.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Nama Bahan</label>
            <input type="text" name="nama_bahan" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Stok</label>
            <input type="number" name="stok" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Satuan</label>
            <input type="text" name="satuan" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <button type="submit"
                style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: bold;">
            Simpan
        </button>
    </form>
</div>
@endsection
