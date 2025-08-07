@extends('layouts.admin')

@section('title', 'Laporan Target Produksi')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Laporan Target Produksi</h2>

<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.laporan.milestone.export_csv', request()->all()) }}" class="btn btn-secondary">Export CSV</a>
    <a href="{{ route('admin.laporan.milestone.export_pdf', request()->all()) }}" class="btn btn-danger" target="_blank">Export PDF</a>
</div>

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem;">No</th>
                <th style="padding: 0.75rem;">Nama Target</th>
                <th style="padding: 0.75rem;">Tanggal Mulai</th>
                <th style="padding: 0.75rem;">Tanggal Selesai</th>
                <th style="padding: 0.75rem;">Target Produksi</th>
                <th style="padding: 0.75rem;">Total Produksi</th>
                <th style="padding: 0.75rem;">Pencapaian (%)</th>
                <th style="padding: 0.75rem;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($milestones as $i => $milestone)
                @php
                    $totalProduksi = $milestone->produksi->sum('stok');
                    $pencapaian = $milestone->target > 0 ? round(($totalProduksi / $milestone->target) * 100, 2) : 0;
                @endphp
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $i + 1 }}</td>
                    <td style="padding: 0.75rem;">{{ $milestone->nama }}</td>
                    <td style="padding: 0.75rem;">{{ $milestone->tanggal_mulai }}</td>
                    <td style="padding: 0.75rem;">{{ $milestone->tanggal_selesai }}</td>
                    <td style="padding: 0.75rem;">{{ $milestone->target }}</td>
                    <td style="padding: 0.75rem;">{{ $totalProduksi }}</td>
                    <td style="padding: 0.75rem;">{{ $pencapaian }}%</td>
                    <td style="padding: 0.75rem;">
                        {{ $milestone->status === 'sudah' ? 'Tercapai' : 'Belum Tercapai' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 1rem;">Tidak ada data target produksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
