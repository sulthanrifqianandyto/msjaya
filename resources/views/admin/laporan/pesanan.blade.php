@extends('layouts.admin')

@section('title', 'Laporan Pesanan')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Laporan Pesanan</h2>

<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.laporan.pesanan.export_csv', request()->all()) }}" class="btn btn-secondary">Export CSV</a>
    <a href="{{ route('admin.laporan.pesanan.export_pdf', request()->all()) }}" class="btn btn-danger" target="_blank">Export PDF</a>
</div>

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem;">ID Pesanan</th>
                <th style="padding: 0.75rem;">Nama Pelanggan</th>
                <th style="padding: 0.75rem;">Item</th>
                <th style="padding: 0.75rem;">Kuantitas</th>
                <th style="padding: 0.75rem;">Alamat</th>
                <th style="padding: 0.75rem;">Status</th>
                <th style="padding: 0.75rem;">Tanggal Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanan as $p)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $p->id_pesanan }}</td>
                    <td style="padding: 0.75rem;">{{ $p->pelanggan->nama ?? '-' }}</td>
                    <td style="padding: 0.75rem;">{{ $p->item }}</td>
                    <td style="padding: 0.75rem;">{{ $p->kuantitas }}</td>
                    <td style="padding: 0.75rem;">{{ $p->alamat }}</td>
                    <td style="padding: 0.75rem;">{{ ucfirst($p->status) }}</td>
                    <td style="padding: 0.75rem;">{{ $p->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 1rem;">Tidak ada data pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
