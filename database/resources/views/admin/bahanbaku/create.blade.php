@extends('layouts.admin')

@section('content')
    <h1>Tambah Bahan Baku</h1>

    <form action="{{ route('admin.bahanbaku.store') }}" method="POST">
        @csrf
        <input type="text" name="nama_bahan" placeholder="Nama Bahan">
        <input type="number" name="stok" placeholder="Stok">
        <input type="text" name="satuan" placeholder="Satuan">
        <input type="date" name="tanggal_masuk" placeholder="Tanggal Masuk">
        <button type="submit">Simpan</button>
    </form>
    
@endsection
