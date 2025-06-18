@extends('layouts.admin')

@section('title', 'Edit Distribusi')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Edit Distribusi</h2>

<div style="background-color: #FAF9F6; padding: 2rem; border-radius: 12px; max-width: 700px;">
    <form action="{{ route('admin.distribusi.update', $distribusi->id_distribusi) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label for="id_pelanggan" style="display:block; font-weight: bold; color: #111111;">Pilih Pelanggan</label>
            <select name="id_pelanggan" id="id_pelanggan" required
                    style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;">
                @foreach ($pelanggan as $p)
                    <option value="{{ $p->id_pelanggan }}"
                        {{ (old('id_pelanggan', $distribusi->id_pelanggan) == $p->id_pelanggan) ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
            @error('id_pelanggan')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="jumlah" style="display:block; font-weight: bold; color: #111111;">Jumlah</label>
            <input type="text" name="jumlah" id="jumlah" value="{{ old('jumlah', $distribusi->jumlah) }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;">
            @error('jumlah')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="tanggal_distribusi" style="display:block; font-weight: bold; color: #111111;">Tanggal Distribusi</label>
            <input type="date" name="tanggal_distribusi" id="tanggal_distribusi" value="{{ old('tanggal_distribusi', $distribusi->tanggal_distribusi) }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;">
            @error('tanggal_distribusi')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit"
                style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: bold;">
            Update
        </button>
    </form>
</div>
@endsection
