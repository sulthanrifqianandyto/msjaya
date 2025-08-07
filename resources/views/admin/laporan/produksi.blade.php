@extends('layouts.admin')

@section('title', 'Laporan Produksi')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Laporan Produksi</h2>

<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.laporan.produksi.export_csv', request()->all()) }}" class="btn btn-secondary">Export CSV</a>
    <a href="{{ route('admin.laporan.produksi.export_pdf', request()->all()) }}" class="btn btn-danger" target="_blank">Export PDF</a>
</div>

<div style="overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem; text-align: left;">No</th>
                <th style="padding: 0.75rem; text-align: left;">Nama Produk</th>
                <th style="padding: 0.75rem; text-align: left;">Jumlah Produksi</th>
                <th style="padding: 0.75rem; text-align: left;">Tanggal Produksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produksi as $index => $item)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $index + 1 }}</td>
                    <td style="padding: 0.75rem;">{{ $item->nama_produk }}</td>
                    <td style="padding: 0.75rem;">{{ $item->jumlah ?? $item->stok }}</td>
                    <td style="padding: 0.75rem;">{{ \Carbon\Carbon::parse($item->tanggal_produksi)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 1rem;">Tidak ada data produksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
