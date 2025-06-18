@extends('layouts.admin')

@section('title', 'Edit Pelanggan')

@section('content')
    <h2 style="color: #14532D; margin-bottom: 1rem;">Edit Pelanggan</h2>

    <div style="background-color: #FAF9F6; padding: 2rem; border-radius: 12px; max-width: 700px;">
        <form action="{{ route('admin.pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 1rem;">
                <label for="nama" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #111111;">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $pelanggan->nama) }}"
                       style="width: 100%; padding: 0.6rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="email" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #111111;">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $pelanggan->email) }}"
                       style="width: 100%; padding: 0.6rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="alamat" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #111111;">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $pelanggan->alamat) }}"
                       style="width: 100%; padding: 0.6rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="no_hp" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #111111;">No HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}"
                       style="width: 100%; padding: 0.6rem; border: 1px solid #A3B18A; border-radius: 6px;" required>
            </div>

            <button type="submit"
                    style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: bold;">
                Update
            </button>
        </form>
    </div>

    <br>
    <a href="{{ route('admin.pelanggan.index') }}"
       style="color: #14532D; text-decoration: underline; font-weight: bold;">
        ← Kembali ke Daftar Pelanggan
    </a>
@endsection
