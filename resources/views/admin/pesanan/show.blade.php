@extends('layouts.admin') {{-- atau layout lain yang kamu gunakan --}}

@section('content')
    <h1>Detail Pesanan</h1>

    <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y') }}</p>
    <p><strong>Item:</strong> {{ $pesanan->item }}</p>
    <p><strong>Kuantitas:</strong> {{ $pesanan->kuantitas }} kg</p>
    <p><strong>Status:</strong> {{ ucfirst($pesanan->status) }}</p>
    <p><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
    <p><strong>Pelanggan:</strong> {{ $pesanan->pelanggan->nama ?? 'Tidak ditemukan' }}</p>
@endsection
