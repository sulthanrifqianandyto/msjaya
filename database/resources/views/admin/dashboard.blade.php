@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard Admin</h2>
    <p style="text-align:center; margin-bottom: 2rem;">Selamat datang kembali di sistem pengelolaan!</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
        <div style="background-color: #1e40af; padding: 1.5rem; border-radius: 12px; text-align: center;">
            <h3 style="margin-bottom: 0.5rem;">Bahan Baku</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $bahanBakuCount }}</p>
            <small>Total Jenis</small>
        </div>

        <div style="background-color: #047857; padding: 1.5rem; border-radius: 12px; text-align: center;">
            <h3 style="margin-bottom: 0.5rem;">Produksi</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $produksiCount }}</p>
            <small>Proses Aktif</small>
        </div>

        <div style="background-color: #b45309; padding: 1.5rem; border-radius: 12px; text-align: center;">
            <h3 style="margin-bottom: 0.5rem;">Distribusi</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $distribusiCount }}</p>
            <small>Pengiriman</small>
        </div>

        <div style="background-color: #6b21a8; padding: 1.5rem; border-radius: 12px; text-align: center;">
            <h3 style="margin-bottom: 0.5rem;">Pelanggan</h3>
            <p style="font-size: 2rem; font-weight: bold;">{{ $pelangganCount }}</p>
            <small>Terdaftar</small>
        </div>
    </div>
@endsection
