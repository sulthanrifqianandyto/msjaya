@extends('layouts.admin')

@section('title', 'Edit Bahan Baku')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Edit Bahan Baku</h2>

<div style="background-color: #FAF9F6; padding: 2rem; border-radius: 12px; max-width: 700px;">
    <form action="{{ route('admin.bahanbaku.update', $bahanbaku->id_bahan) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Nama Bahan</label>
            <input type="text" name="nama_bahan" value="{{ $bahanbaku->nama_bahan }}"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Stok (kg)</label>
            <div style="display: flex; align-items: center;">
                <input type="number" name="stok" value="{{ $bahanbaku->stok }}" step="0.01" min="0"
                       style="flex: 1; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px 0 0 6px; background-color: #ffffff;" required>
                <span style="background-color: #14532D; color: #fff; padding: 0.5rem 1rem; border-radius: 0 6px 6px 0;">kg</span>
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="{{ $bahanbaku->tanggal_masuk }}"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <button type="submit"
                style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: bold;">
            Update
        </button>
    </form>
</div>
@endsection
