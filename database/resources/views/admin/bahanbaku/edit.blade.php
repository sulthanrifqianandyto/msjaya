@extends('layouts.admin')

@section('content')
    <h1>Edit Bahan Baku</h1>

    <form action="{{ route('admin.bahanbaku.update', $bahanbaku->id_bahan) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Bahan:</label>
            <input type="text" name="nama_bahan" value="{{ old('nama_bahan', $bahanbaku->nama_bahan) }}" required>
        </div>

        <div>
            <label>Stok:</label>
            <input type="number" name="stok" value="{{ old('stok', $bahanbaku->stok) }}" required>
        </div>

        <div>
            <label>Satuan:</label>
            <input type="text" name="satuan" value="{{ old('satuan', $bahanbaku->satuan) }}" required>
        </div>

        <div>
            <label>Tanggal Masuk:</label>
            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $bahanbaku->tanggal_masuk) }}" required>
        </div>

        <button type="submit">Perbarui</button>
    </form>
@endsection
