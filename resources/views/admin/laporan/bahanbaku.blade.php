@extends('layouts.admin')

@section('title', 'Laporan Bahan Baku')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Laporan Bahan Baku</h2>

<a href="{{ route('admin.laporan.bahanbaku.export_csv', request()->all()) }}" class="btn btn-secondary">Export CSV</a>

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem;">Nama Bahan</th>
                <th style="padding: 0.75rem;">Stok</th>
                <th style="padding: 0.75rem;">Tanggal Masuk</th>
                <th style="padding: 0.75rem;">Alamat Suplier</th>
                <th style="padding: 0.75rem;">Wilayah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bahanBakus as $bahan)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $bahan->nama_bahan }}</td>
                    <td style="padding: 0.75rem;">{{ $bahan->stok }}</td>
                    <td style="padding: 0.75rem;">{{ $bahan->tanggal_masuk }}</td>
                    <td style="padding: 0.75rem;">{{ $bahan->alamat_suplier }}</td>
                    <td style="padding: 0.75rem;">
                        {{ $bahan->kelurahan->nama ?? '-' }},
                        {{ $bahan->kecamatan->nama ?? '-' }},
                        {{ $bahan->kabupaten->nama ?? '-' }},
                        {{ $bahan->provinsi->nama ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 1rem;">Tidak ada data bahan baku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
