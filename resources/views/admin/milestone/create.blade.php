@extends('layouts.admin')

@section('title', 'Tambah Milestone')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Tambah Milestone</h2>

<div style="background-color: #FAF9F6; padding: 2rem; border-radius: 12px; max-width: 700px;">
    <form action="{{ route('admin.milestone.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label for="nama" style="display:block; font-weight: bold; color: #111111;">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;">
            @error('nama')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="tanggal_mulai" style="display:block; font-weight: bold; color: #111111;">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;">
            @error('tanggal_mulai')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="tanggal_selesai" style="display:block; font-weight: bold; color: #111111;">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;">
            @error('tanggal_selesai')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="target" style="display:block; font-weight: bold; color: #111111;">Target Produksi (kg)</label>
            <input type="number" name="target" id="target" value="{{ old('target') }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;">
            @error('target')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit"
                style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: bold;">
            Simpan
        </button>
        <a href="{{ route('admin.milestone.index') }}"
           style="margin-left: 1rem; color: #555555; text-decoration: underline;">
           Batal
        </a>
    </form>
</div>
@endsection
