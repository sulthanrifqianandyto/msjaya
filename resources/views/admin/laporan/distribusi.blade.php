@extends('layouts.admin')

@section('title', 'Laporan Distribusi')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Laporan Distribusi</h2>

<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.laporan.distribusi.export_csv', request()->all()) }}" class="btn btn-secondary">Export CSV</a>
    <a href="{{ route('admin.laporan.distribusi.export_pdf', request()->all()) }}" class="btn btn-danger" target="_blank">Export PDF</a>
</div>

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem;">Tanggal Distribusi</th>
                <th style="padding: 0.75rem;">Nama Pelanggan</th>
                <th style="padding: 0.75rem;">Alamat</th>
                <th style="padding: 0.75rem;">Jumlah</th>
                <th style="padding: 0.75rem;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($distribusis as $item)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $item->tanggal_distribusi }}</td>
                    <td style="padding: 0.75rem;">{{ $item->pesanan->pelanggan->nama ?? '-' }}</td>
                    <td style="padding: 0.75rem;">{{ $item->pesanan->alamat ?? '-' }}</td>
                    <td style="padding: 0.75rem;">{{ $item->jumlah }}</td>
                    <td style="padding: 0.75rem;">{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 1rem;">Tidak ada data distribusi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
